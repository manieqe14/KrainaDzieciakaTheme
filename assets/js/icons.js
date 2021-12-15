$(document).ready(function(){
    //basket icon on add to cart button
    var basket_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="button-icons" viewBox="0 0 576 512"><path d="M576 216v16c0 13.255-10.745 24-24 24h-8l-26.113 182.788C514.509 462.435 494.257 480 470.37 480H105.63c-23.887 0-44.139-17.565-47.518-41.212L32 256h-8c-13.255 0-24-10.745-24-24v-16c0-13.255 10.745-24 24-24h67.341l106.78-146.821c10.395-14.292 30.407-17.453 44.701-7.058 14.293 10.395 17.453 30.408 7.058 44.701L170.477 192h235.046L326.12 82.821c-10.395-14.292-7.234-34.306 7.059-44.701 14.291-10.395 34.306-7.235 44.701 7.058L484.659 192H552c13.255 0 24 10.745 24 24zM312 392V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm112 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm-224 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24z"/></svg>';
    $('button[name="add-to-cart"], button.single_add_to_cart_button').append(basket_icon);

    //arrows on product description
    var arrow_left = '<svg version="1.1" class="product-description-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"     viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve"><path d="M388.425,241.951L151.609,5.79c-7.759-7.733-20.321-7.72-28.067,0.04c-7.74,7.759-7.72,20.328,0.04,28.067l222.72,222.105 L123.574,478.106c-7.759,7.74-7.779,20.301-0.04,28.061c3.883,3.89,8.97,5.835,14.057,5.835c5.074,0,10.141-1.932,14.017-5.795 l236.817-236.155c3.737-3.718,5.834-8.778,5.834-14.05S392.156,245.676,388.425,241.951z"/></svg>';
    $('.product-description ul li, .woocommerce-product-details__short-description ul li').append(arrow_left);

    //home at breadcumbs
    var home = '<svg version="1.1" class="breadcumbs-home-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 463.937 463.937" style="enable-background:new 0 0 463.937 463.937;" xml:space="preserve"><path d="M460.414,216.518l-85.6-73.1c0.1-0.5,0.2-1,0.3-1.6v-95.6c-0.1-5.7-4.6-10.3-10.3-10.5h-47.8c-5.5,0-10,4.9-10,10.5v39.6 l-68.5-58.4c-3.7-3.2-9.2-3.2-13,0l-221.9,189c-4.3,3.5-4.8,9.8-1.3,14.1s9.8,4.8,14.1,1.3c0.1-0.1,0.1-0.1,0.2-0.2l215.4-183.4 l77.1,65.7l46.1,39.2l92.3,78.6c4.2,3.6,10.5,3.1,14.1-1.1C465.114,226.418,464.614,220.118,460.414,216.518z M355.014,126.518 l-28-23.6v-47.1h28V126.518z"/><path d="M416.314,236.718l-28.1-24l-149.7-127.9c-3.7-3.2-9.2-3.2-13,0l-149.7,127.9l-28.1,24c-4.2,3.6-4.7,9.9-1.1,14.1 c3.5,4.2,9.7,4.7,13.8,1.2l0.1-0.1l12.5-10.8v187.5c0.1,5.6,4.7,10.2,10.3,10.3h297.3c5.6-0.1,10.2-4.6,10.3-10.3v-187.5 l12.5,10.8c1.8,1.5,4,2.4,6.4,2.4c2.9,0,5.7-1.3,7.6-3.5C421.114,246.518,420.514,240.218,416.314,236.718z M272.014,418.818h-80 v-108h80V418.818z M292.014,418.818v-117.7c0-5.5-4.1-10.3-9.6-10.3h-100.8c-5.5,0-9.6,4.8-9.6,10.3v117.7h-79v-194.8l139-118.4 l139,118.4v194.8H292.014z"/></svg>';
    $('nav.woocommerce-breadcrumb').append(home);

    //mobile menu toggle
    var mobile_menu_toggle = '<svg version="1.1" id="mobile-menu-toggle-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve"><path d="M581.4,520.199H30.6c-16.891,0-30.6,13.709-30.6,30.6C0,567.691,13.709,581.4,30.6,581.4h550.8 c16.891,0,30.6-13.709,30.6-30.602C612,533.908,598.291,520.199,581.4,520.199z M30.6,91.799h550.8 c16.891,0,30.6-13.708,30.6-30.6c0-16.892-13.709-30.6-30.6-30.6H30.6C13.709,30.6,0,44.308,0,61.2 C0,78.091,13.709,91.799,30.6,91.799z M581.4,275.399H30.6C13.709,275.399,0,289.108,0,306s13.709,30.6,30.6,30.6h550.8 c16.891,0,30.6-13.709,30.6-30.6S598.291,275.399,581.4,275.399z"/></svg>';
    $('#menu-mobile-toggle-link').append(mobile_menu_toggle);

    //mobile filters toggle
    var filters_toggle = '<svg id="mobile-filters-toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" /></svg>';
    $('#mobile-filters-toggle').append(filters_toggle);

    //mobile filters close icon
    var close_filters_icon = '<svg id="close-filters-icon" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 241.171 241.171" style="enable-background:new 0 0 241.171 241.171;" xml:space="preserve">  <path id="Close" d="M138.138,120.754l99.118-98.576c4.752-4.704,4.752-12.319,0-17.011c-4.74-4.704-12.439-4.704-17.179,0 l-99.033,98.492L21.095,3.699c-4.74-4.752-12.439-4.752-17.179,0c-4.74,4.764-4.74,12.475,0,17.227l99.876,99.888L3.555,220.497 c-4.74,4.704-4.74,12.319,0,17.011c4.74,4.704,12.439,4.704,17.179,0l100.152-99.599l99.551,99.563 c4.74,4.752,12.439,4.752,17.179,0c4.74-4.764,4.74-12.475,0-17.227L138.138,120.754z"/></svg>';
    $('#close-widgets-mobile').append(close_filters_icon);

    //mobile menu close icon
    var close_menu_icon = '<svg id="close-menu-icon" version="1.1"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 241.171 241.171" style="enable-background:new 0 0 241.171 241.171;" xml:space="preserve">  <path id="Close" d="M138.138,120.754l99.118-98.576c4.752-4.704,4.752-12.319,0-17.011c-4.74-4.704-12.439-4.704-17.179,0 l-99.033,98.492L21.095,3.699c-4.74-4.752-12.439-4.752-17.179,0c-4.74,4.764-4.74,12.475,0,17.227l99.876,99.888L3.555,220.497 c-4.74,4.704-4.74,12.319,0,17.011c4.74,4.704,12.439,4.704,17.179,0l100.152-99.599l99.551,99.563 c4.74,4.752,12.439,4.752,17.179,0c4.74-4.764,4.74-12.475,0-17.227L138.138,120.754z"/></svg>';
    $('#mobile-menu').append(close_menu_icon);

    //expand filters icon
    var expand_icon = '<svg class="expand-filter-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 240.811 240.811" style="enable-background:new 0 0 240.811 240.811;" xml:space="preserve"><path id="Expand_More" d="M220.088,57.667l-99.671,99.695L20.746,57.655c-4.752-4.752-12.439-4.752-17.191,0 c-4.74,4.752-4.74,12.451,0,17.203l108.261,108.297l0,0l0,0c4.74,4.752,12.439,4.752,17.179,0L237.256,74.859 c4.74-4.752,4.74-12.463,0-17.215C232.528,52.915,224.828,52.915,220.088,57.667z"/></svg>';
    $('.bapf_hascolarr').append(expand_icon);

    $('.expand-filter-icon').click(function(){
        $(this).toggleClass('rotate-icon');
    });

});

