<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package MShop
 * @subpackage Coupon
 */


namespace Aimeos\MShop\Coupon\Provider;


/**
 * Gift/present coupon model.
 *
 * @package MShop
 * @subpackage Coupon
 */
class Present
	extends \Aimeos\MShop\Coupon\Provider\Factory\Base
	implements \Aimeos\MShop\Coupon\Provider\Factory\Iface
{
	/**
	 * Adds the result of a coupon to the order base instance.
	 *
	 * @param \Aimeos\MShop\Order\Item\Base\Iface $base Basic order of the customer
	 */
	public function addCoupon( \Aimeos\MShop\Order\Item\Base\Iface $base )
	{
		if( $this->getObject()->isAvailable( $base ) === false ) {
			return;
		}

		$config = $this->getItemBase()->getConfig();

		if( !isset( $config['present.productcode'] ) || !isset( $config['present.quantity'] ) )
		{
			throw new \Aimeos\MShop\Coupon\Exception( sprintf(
				'Invalid configuration for coupon provider "%1$s", needs "%2$s"',
				$this->getItemBase()->getProvider(), 'present.productcode, present.quantity'
			) );
		}

		$orderProduct = $this->createProduct( $config['present.productcode'], $config['present.quantity'] );

		$base->addCoupon( $this->getCode(), array( $orderProduct ) );
	}
}
