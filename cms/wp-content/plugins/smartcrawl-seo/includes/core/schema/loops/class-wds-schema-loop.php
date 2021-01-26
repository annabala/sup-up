<?php

class Smartcrawl_Schema_Loop {
	public static function create( $id, $post ) {
		switch ( $id ) {
			case Smartcrawl_Schema_Loop_Woocommerce_Reviews::ID:
				return new Smartcrawl_Schema_Loop_Woocommerce_Reviews( $post );

			default:
				return null;
		}
	}
}
