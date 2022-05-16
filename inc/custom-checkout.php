<?php

function villacloset_custom_checkout($fields)
{
  return $fields;
}


add_filter('woocommerce_checkout_fields', 'villacloset_custom_checkout');