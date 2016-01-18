<?php
include_once("class-fortnox3-xml.php");
class WCF_Product_XML_Document extends WCF_XML_Document{

    /**
     *
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Creates a XML representation of a Product
     *
     * @access public
     * @param mixed $product
     * @return mixed
     */
    public function create($product){

        $root = 'Article';
        $productNode = array();
        $productNode['Description'] = $product->get_title();
        $productNode['StockGoods'] = true;
        $productNode['QuantityInStock'] = $product->get_stock_quantity();
        $productNode['Unit'] = 'st';
        $productNode['ArticleNumber'] = $product->get_sku();

        $options = get_option('woocommerce_fortnox_advanced_accounting_settings');

        $tax_class = $this->get_tax_class_by_tax_name($product->get_tax_class());

        if(!empty($options['product_eu_sales_account'])){
            $productNode['EUAccount'] = $options['product_eu_sales_account'];
        }

        if(!empty($options['product_eu_sales_vat_account'])){
            $productNode['EUVATAccount']= $options['product_eu_sales_vat_account'];
        }

        if(!empty($options['product_export_sales_account'])){
            $productNode['ExportAccount']= $options['product_export_sales_account'];
        }

        if(!empty($options['product_sales_account_' . $tax_class])){
            $productNode['SalesAccount'] = $options['product_sales_account_' . $tax_class];
        }

        if(!empty($options['product_purchase_account'])){
            $productNode['PurchaseAccount'] = $options['product_purchase_account'];
        }
        logthis($productNode);
        return $this->generate($root, $productNode);
    }

    /**
     * Updates a XML representation of a Product
     *
     * @access public
     * @param mixed $product
     * @return mixed
     */
    public function update($product){

        $root = 'Article';
        $productNode = array();
        $productNode['Description'] = $product->get_title();
        $productNode['ArticleNumber'] = $product->get_sku();
        $productNode['StockGoods'] = true;
        $productNode['QuantityInStock'] = $product->managing_stock() ? $product->get_stock_quantity() : 0;
        $productNode['Unit'] = 'st';

        $options = get_option('woocommerce_fortnox_advanced_accounting_settings');

        $tax_class = $this->get_tax_class_by_tax_name($product->get_tax_class());
        logthis($tax_class);
        if(!empty($options['product_eu_sales_account'])){
            $productNode['EUAccount'] = $options['product_eu_sales_account'];
        }

        if(!empty($options['product_eu_sales_vat_account'])){
            $productNode['EUVATAccount']= $options['product_eu_sales_vat_account'];
        }

        if(!empty($options['product_export_sales_account'])){
            $productNode['ExportAccount']= $options['product_export_sales_account'];
        }
        logthis('R: ' . $options['product_sales_account_' . $tax_class]);
        if(!empty($options['product_sales_account_' . $tax_class])){
            $productNode['SalesAccount'] = $options['product_sales_account_' . $tax_class];
        }

        if(!empty($options['product_purchase_account'])){
            $productNode['PurchaseAccount'] = $options['product_purchase_account'];
        }

        return $this->generate($root, $productNode);
    }

    /**
     * Creates a XML representation of a Product
     *
     * @access public
     * @param mixed $product
     * @return mixed
     */
    public function create_price($product){

        $root = 'Price';
        $options = get_option('woocommerce_fortnox_general_settings');
        $price = array();

        if(!isset($options['default-pricelist'])){
            $price['PriceList'] = 'A';
        }
        else{
            if($options['default-pricelist'] != ''){
                $price['PriceList'] = $options['default-pricelist'];
            }
            else{
                $price['PriceList'] = 'A';
            }
        }

        if($options['product-price-including-vat'] == 'on'){
            $price['Price'] = $product->get_price_including_tax();
        }
        else{
            $price['Price'] = $product->get_price_excluding_tax();
        }


        $price['ArticleNumber'] = $product->get_sku();
        $price['FromQuantity'] = 1;

        return $this->generate($root, $price);
    }

    /**
     * Creates a XML representation of a Product
     *
     * @access public
     * @param mixed $product
     * @return mixed
     */
    public function update_price($product){

        $root = 'Price';
        $price = array();

        $options = get_option('woocommerce_fortnox_general_settings');

        if(!isset($options['default-pricelist'])){
            $price['PriceList'] = 'A';
        }
        else{
            if($options['default-pricelist'] != ''){
                $price['PriceList'] = $options['default-pricelist'];
            }
            else{
                $price['PriceList'] = 'A';
            }
        }

        $price['Price'] = $product->get_price_excluding_tax();

        if($options['product-price-including-vat'] == 'on'){
            $price['Price'] = $product->get_price_including_tax();
        }
        else{
            $price['Price'] = $product->get_price_excluding_tax();
        }
        return $this->generate($root, $price);
    }

    /**
     * Returns a products taxrate
     *
     * @access public
     * @param $tax_name
     * @return int
     */
    public function get_tax_class_by_tax_name( $tax_name ) {
        global $wpdb;
        if($tax_name == ''){
            return 25;
        }
        $tax_rate = $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_class = %s", $tax_name ) );

        return intval($tax_rate);
    }
}