<?php
include_once("class-fortnox3-xml.php");

class WCF_Order_XML_Document extends WCF_XML_Document{

    /**
     *
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Creates a n XML representation of an Order
     *
     * @access public
     * @param mixed $arr
     * @param $customerNumber
     * @return mixed
     */
    public function create($arr, $customerNumber){

        $orderOptions = get_option('woocommerce_fortnox_order_settings');
        $freight_options = get_option('woocommerce_fortnox_freight_settings');

        $root = 'Order';

        $seq_order_number = get_post_meta($arr->id, '_order_number', true);
        if(!empty($seq_order_number)){
            logthis($seq_order_number);
            $order['DocumentNumber'] = $seq_order_number;
        }
        else{
            $order['DocumentNumber'] = $arr->id;
        }
        $order['AdministrationFee'] = $orderOptions['admin-fee'];
        $order['OrderDate'] =  substr($arr->order_date, 0, 10);
        $order['DeliveryDate'] = substr($arr->order_date, 0, 10);
        $order['Currency'] = $arr->get_order_currency();
        $order['CurrencyRate'] = '1';
        $order['CurrencyUnit'] = '1';
        $order['YourOrderNumber'] = $arr->id;
        $order['CustomerNumber'] = $customerNumber;
        $order['Address1'] = $arr->billing_address_1;
        $order['City'] = $arr->billing_city;
        $order['Country'] = $this->countries[$arr->billing_country];
        $order['Phone1'] = $arr->billing_phone;
        $order['DeliveryAddress1'] = $arr->shipping_address_1;
        $order['DeliveryCity'] = $arr->shipping_city;
        $order['DeliveryCountry'] = $this->countries[$arr->shipping_country];
        $order['DeliveryZipCode'] =  $arr->shipping_postcode;

        $shipping_methods = $arr->get_shipping_methods();
        $shipping_method = reset($shipping_methods);
        if(!empty($shipping_method)){
            if(!empty($shipping_method['method_id'])){
                if(isset($freight_options[$shipping_method['method_id']])){
                    $order['WayOfDelivery'] = $freight_options[$shipping_method['method_id']];
                }
            }
        }

        if($arr->payment_method == 'klarna_checkout'){
            $order['ExternalInvoiceReference1'] =  $arr->id;
        }
        
        if(isset($arr->billing_company) && $arr->billing_company != ''){
            $order['CustomerName'] = $arr->billing_company;
            $order['YourReference'] = $arr->billing_first_name . " " . $arr->billing_last_name;
        }
        else{
            $order['CustomerName'] = $arr->billing_first_name . " " . $arr->billing_last_name;
            $order['DeliveryName'] = $arr->billing_first_name . " " . $arr->billing_last_name;
        }

        if($orderOptions['payment-options'] != ''){
            $order['TermsOfPayment'] = $orderOptions['payment-options'];
        }

        if($orderOptions['cost-center'] != ''){
            $order['CostCenter'] = $orderOptions['cost-center'];
        }

        $include_freight_tax = get_option('woocommerce_prices_include_tax');

        if($include_freight_tax == 'yes'){
            $order['Freight'] = $arr->get_total_shipping() *0.8;
        }
        else{
            $order['Freight'] = $arr->get_total_shipping();
        }


        $order['VATIncluded'] = 'false';

        if($orderOptions['add-payment-type'] == 'on'){
            $payment_method = get_post_meta( $arr->id, '_payment_method_title');
            $order['Remarks'] = $payment_method[0];
        }

        $email = array();
        $email['EmailAddressTo'] = $arr->billing_email;
        $order['EmailInformation'] =  $email;

        $invoicerows = array();

        //loop all items
        $index = 0;
        $pf = new WC_Product_Factory();
        foreach($arr->get_items() as $item){
            $key = "OrderRow" . $index;

            //if variable product there might be a different SKU
            $is_variation = false;
            if(empty($item['variation_id'])){
                $productId = $item['product_id'];
            }
            else{
                $productId = $item['variation_id'];
                $is_variation = true;
            }

            $product = $pf->get_product($productId);

            //handles missing product
            $invoicerow = array();

            if(!($product==NULL)){//!is_null($product)
                $invoicerow['ArticleNumber'] = $product->get_sku();
            }

            $invoicerow['Description'] = $this->get_item_name($item, $product, $is_variation);
            $invoicerow['Unit'] = 'st';
            $invoicerow['DeliveredQuantity'] = $item['qty'];
            $invoicerow['OrderedQuantity'] = $item['qty'];
            $invoicerow['Price'] = $this->get_product_price($item)/$item['qty'];
            $invoicerow['VAT'] = $this->get_tax_class_by_tax_name($product->get_tax_class(), $arr->shipping_country);
            $index += 1;
            $invoicerows[$key] = $invoicerow;
        }

        /****HANDLE FEES*****/
        foreach($arr->get_fees() as $item){
            $key = "OrderRow" . $index;

            $invoicerow['Description'] = $item['name'];
            $invoicerow['Unit'] = 'st';
            $invoicerow['DeliveredQuantity'] = 1;
            $invoicerow['OrderedQuantity'] = 1;
            $invoicerow['Price'] = $item['line_total'];
            $invoicerow['VAT'] = 25;

            $index += 1;
            $invoicerows[$key] = $invoicerow;
        }

        if($arr->get_total_discount() > 0){

            $coupon = $arr->get_used_coupons();
            $coupon = new WC_Coupon($coupon[0]);
            if(!$coupon->apply_before_tax()){
                $key = "OrderRow" . $index;
                $invoicerow = array();

                $invoicerow['Description'] = "Rabatt";
                $invoicerow['Unit'] = 'st';
                $invoicerow['DeliveredQuantity'] = 1;
                $invoicerow['OrderedQuantity'] = 1;
                $invoicerow['Price'] = -1 * $arr->get_total_discount();
                $invoicerow['VAT'] = 0;
                $invoicerows[$key] = $invoicerow;
                $index += 1;
            }
        }

        /****HANDLE PRODUCT AS FREIGHT*****/
        if(!empty($orderOptions['freight-product-sku'])){

            //RESET FREIGHT
            $order['Freight'] = 0;

            $product = $this->get_product_by_sku($orderOptions['freight-product-sku']);
            $key = "OrderRow" . $index;
            $invoicerow['ArticleNumber'] = $orderOptions['freight-product-sku'];
            $invoicerow['Description'] = $product->get_title();
            $invoicerow['Unit'] = 'st';
            $invoicerow['DeliveredQuantity'] = 1;
            $invoicerow['OrderedQuantity'] = 1;
            $invoicerow['Price'] = $arr->get_total_shipping();
            $invoicerow['VAT'] = $this->get_tax_class_by_tax_name($product->get_tax_class(), $arr->shipping_country);

            $invoicerows[$key] = $invoicerow;
        }


        $order['OrderRows'] = $invoicerows;

        logthis(print_r($order, true));

        return $this->generate($root, $order);
    }

    /**
     * Sums up price and tax from order line
     *
     * @access private
     * @param mixed $product
     * @return float
     */
    private function get_product_price($product){
        return floatval($product['line_total']);
    }

    /**
     * Sums up price and tax from order line
     *
     * @access private
     * @param mixed $item
     * @param mixed $product
     * @param mixed $is_variation
     * @return float
     */
    private function get_item_name($item, $product, $is_variation){
        if(!$is_variation)
            return $this->truncate_over_fifty($item['name']);

        $attribute_keys = array();
        $attributes = $product->get_attributes();
        foreach($attributes as $k =>$v){
            if($v['is_variation'] == 1){
                array_push($attribute_keys, $k);
            }
        }
        if(count($attribute_keys) > 0){
            $str = '';
            foreach($attribute_keys as $k){
                $str .= $item[$k];
            }
            return $this->truncate_over_fifty($item['name'] . ' - ' . $str);
        }
        else{
            return $this->truncate_over_fifty($item['name']);
        }
    }

    private function truncate_over_fifty($str){
        if(strlen($str) > 49){
            return substr($str, 0, 49);
        }
        return $str;
    }

    /**
     * Returns a products taxrate
     *
     * @access public
     * @param $tax_name
     * @param $location
     * @return int
     */
    public function get_tax_class_by_tax_name( $tax_name, $location ) {
        global $wpdb;
        //search country specific taxrate
        $tax_rate = $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_class = %s AND tax_rate_country = %s", $tax_name, $location ) );

        if($tax_rate){
            return intval($tax_rate);
        }
        //if no country specific taxrate search for generic taxrate
        $tax_rate = $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_class = %s AND tax_rate_country = ''", $tax_name ) );

        if($tax_rate){
            return intval($tax_rate);
        }
        return 0;

    }

    private function get_product_by_sku( $sku ) {
        global $wpdb;

        $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

        if ( $product_id ) return new WC_Product( $product_id );

        return null;
    }
}
