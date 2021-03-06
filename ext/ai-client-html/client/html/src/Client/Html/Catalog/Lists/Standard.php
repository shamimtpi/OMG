<?php

/**
 * @copyright Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Catalog\Lists;


/**
 * Default implementation of catalog list section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Catalog\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/catalog/lists/standard/subparts
	 * List of HTML sub-clients rendered within the catalog list section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartPath = 'client/html/catalog/lists/standard/subparts';

	/** client/html/catalog/lists/head/name
	 * Name of the head part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Head\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/lists/quote/name
	 * Name of the quote part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Quote\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/lists/promo/name
	 * Name of the promotion part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Promo\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/lists/type/name
	 * Name of the type part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Type\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2016.07
	 * @category Developer
	 */

	/** client/html/catalog/lists/pagination/name
	 * Name of the pagination part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Pagination\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/lists/items/name
	 * Name of the items part used by the catalog list client implementation
	 *
	 * Use "Myname" if your class is named "\Aimeos\Client\Html\Catalog\Lists\Items\Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartNames = array( 'head', 'quote', 'promo', 'type', 'pagination', 'items', 'pagination' );

	private $tags = array();
	private $expire;
	private $cache;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return string HTML code
	 */
	public function getBody( $uid = '', array &$tags = array(), &$expire = null )
	{
		$prefixes = array( 'f', 'l' );
		$context = $this->getContext();

		/** client/html/catalog/list
		 * All parameters defined for the catalog list component and its subparts
		 *
		 * This returns all settings related to the filter component.
		 * Please refer to the single settings for details.
		 *
		 * @param array Associative list of name/value settings
		 * @category Developer
		 * @see client/html/catalog#list
		 */
		$confkey = 'client/html/catalog/lists';

		if( ( $html = $this->getCached( 'body', $uid, $prefixes, $confkey ) ) === null )
		{
			$view = $this->getView();

			try
			{
				$view = $this->setViewParams( $view, $tags, $expire );

				$html = '';
				foreach( $this->getSubClients() as $subclient ) {
					$html .= $subclient->setView( $view )->getBody( $uid, $tags, $expire );
				}
				$view->listBody = $html;
			}
			catch( \Aimeos\Client\Html\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
				$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
			}
			catch( \Aimeos\Controller\Frontend\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
				$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
			}
			catch( \Aimeos\MShop\Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
				$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
			}
			catch( \Exception $e )
			{
				$context->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );

				$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
				$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
			}

			/** client/html/catalog/lists/standard/template-body
			 * Relative path to the HTML body template of the catalog list client.
			 *
			 * The template file contains the HTML code and processing instructions
			 * to generate the result shown in the body of the frontend. The
			 * configuration string is the path to the template file relative
			 * to the templates directory (usually in client/html/templates).
			 *
			 * You can overwrite the template file configuration in extensions and
			 * provide alternative templates. These alternative templates should be
			 * named like the default one but with the string "standard" replaced by
			 * an unique name. You may use the name of your project for this. If
			 * you've implemented an alternative client class as well, "standard"
			 * should be replaced by the name of the new class.
			 *
			 * It's also possible to create a specific template for each type, e.g.
			 * for the grid, list or whatever view you want to offer your users. In
			 * that case, you can configure the template by adding "-<type>" to the
			 * configuration key. To configure an alternative list view template for
			 * example, use the key
			 *
			 * client/html/catalog/lists/standard/template-body-list = catalog/lists/body-list.php
			 *
			 * The argument is the relative path to the new template file. The type of
			 * the view is determined by the "l_type" parameter (allowed characters for
			 * the types are a-z and 0-9), which is also stored in the session so users
			 * will keep the view during their visit. The catalog list type subpart
			 * contains the template for switching between list types.
			 *
			 * @param string Relative path to the template creating code for the HTML page body
			 * @since 2014.03
			 * @category Developer
			 * @see client/html/catalog/lists/standard/template-header
			 * @see client/html/catalog/lists/type/standard/template-body
			 */
			$tplconf = 'client/html/catalog/lists/standard/template-body';
			$default = 'catalog/lists/body-default.php';

			$html = $view->render( $this->getTemplatePath( $tplconf, $default ) );

			$this->setCached( 'body', $uid, $prefixes, $confkey, $html, $tags, $expire );
		}
		else
		{
			$html = $this->modifyBody( $html, $uid );
		}

		return $html;
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( $uid = '', array &$tags = array(), &$expire = null )
	{
		$prefixes = array( 'f', 'l' );
		$context = $this->getContext();
		$confkey = 'client/html/catalog/lists';

		if( ( $html = $this->getCached( 'header', $uid, $prefixes, $confkey ) ) === null )
		{
			$view = $this->getView();

			try
			{
				$view = $this->setViewParams( $view, $tags, $expire );

				$html = '';
				foreach( $this->getSubClients() as $subclient ) {
					$html .= $subclient->setView( $view )->getHeader( $uid, $tags, $expire );
				}
				$view->listHeader = $html;
			}
			catch( \Exception $e )
			{
				$context->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );
				return;
			}

			/** client/html/catalog/lists/standard/template-header
			 * Relative path to the HTML header template of the catalog list client.
			 *
			 * The template file contains the HTML code and processing instructions
			 * to generate the HTML code that is inserted into the HTML page header
			 * of the rendered page in the frontend. The configuration string is the
			 * path to the template file relative to the templates directory (usually
			 * in client/html/templates).
			 *
			 * You can overwrite the template file configuration in extensions and
			 * provide alternative templates. These alternative templates should be
			 * named like the default one but with the string "standard" replaced by
			 * an unique name. You may use the name of your project for this. If
			 * you've implemented an alternative client class as well, "standard"
			 * should be replaced by the name of the new class.
			 *
			 * It's also possible to create a specific template for each type, e.g.
			 * for the grid, list or whatever view you want to offer your users. In
			 * that case, you can configure the template by adding "-<type>" to the
			 * configuration key. To configure an alternative list view template for
			 * example, use the key
			 *
			 * client/html/catalog/lists/standard/template-header-list = catalog/lists/header-list.php
			 *
			 * The argument is the relative path to the new template file. The type of
			 * the view is determined by the "l_type" parameter (allowed characters for
			 * the types are a-z and 0-9), which is also stored in the session so users
			 * will keep the view during their visit. The catalog list type subpart
			 * contains the template for switching between list types.
			 *
			 * @param string Relative path to the template creating code for the HTML page head
			 * @since 2014.03
			 * @category Developer
			 * @see client/html/catalog/lists/standard/template-body
			 * @see client/html/catalog/lists/type/standard/template-body
			 */
			$tplconf = 'client/html/catalog/lists/standard/template-header';
			$default = 'catalog/lists/header-default.php';

			$html = $view->render( $this->getTemplatePath( $tplconf, $default ) );

			$this->setCached( 'header', $uid, $prefixes, $confkey, $html, $tags, $expire );
		}
		else
		{
			$html = $this->modifyHeader( $html, $uid );
		}

		return $html;
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( $type, $name = null )
	{
		/** client/html/catalog/lists/decorators/excludes
		 * Excludes decorators added by the "common" option from the catalog list html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/catalog/lists/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2014.05
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/lists/decorators/global
		 * @see client/html/catalog/lists/decorators/local
		 */

		/** client/html/catalog/lists/decorators/global
		 * Adds a list of globally available decorators only to the catalog list html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/lists/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2014.05
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/lists/decorators/excludes
		 * @see client/html/catalog/lists/decorators/local
		 */

		/** client/html/catalog/lists/decorators/local
		 * Adds a list of local decorators only to the catalog list html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Catalog\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/lists/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Catalog\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2014.05
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/lists/decorators/excludes
		 * @see client/html/catalog/lists/decorators/global
		 */

		return $this->createSubClient( 'catalog/lists/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. store given values.
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables.
	 */
	public function process()
	{
		$context = $this->getContext();
		$view = $this->getView();

		try
		{
			$site = $context->getLocale()->getSite()->getCode();
			$params = $this->getClientParams( $view->param() );
			$context->getSession()->set( 'aimeos/catalog/lists/params/last/' . $site, $params );

			parent::process();
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
		}
		catch( \Exception $e )
		{
			$context->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );

			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->listErrorList = $view->get( 'listErrorList', array() ) + $error;
		}
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames()
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\MW\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\MW\View\Iface Modified view object
	 */
	protected function setViewParams( \Aimeos\MW\View\Iface $view, array &$tags = array(), &$expire = null )
	{
		if( !isset( $this->cache ) )
		{
			$context = $this->getContext();
			$config = $context->getConfig();

			$products = $this->getProductList( $view );

			$text = (string) $view->param( 'f_search' );
			$catid = (string) $view->param( 'f_catid' );

			if( $catid == '' ) {
				$catid = $config->get( 'client/html/catalog/lists/catid-default', '' );
			}

			if( $text === '' && $catid !== '' )
			{
				$domains = $config->get( 'client/html/catalog/domains', array( 'media', 'text' ) );
				$controller = \Aimeos\Controller\Frontend\Factory::createController( $context, 'catalog' );

				$catids = ( !is_array( $catid ) ? explode( ',', $catid ) : $catid );
				$listCatPath = $controller->getCatalogPath( reset( $catids ), $domains );

				if( ( $categoryItem = end( $listCatPath ) ) !== false ) {
					$view->listCurrentCatItem = $categoryItem;
				}

				$view->listCatPath = $listCatPath;

				$this->addMetaItem( $listCatPath, 'catalog', $this->expire, $this->tags );
				$this->addMetaList( array_keys( $listCatPath ), 'catalog', $this->expire );
			}

			/** client/html/catalog/lists/stock/enable
			 * Enables or disables displaying product stock levels in product list views
			 *
			 * This configuration option allows shop owners to display product
			 * stock levels for each product in list views or to disable
			 * fetching product stock information.
			 *
			 * The stock information is fetched via AJAX and inserted via Javascript.
			 * This allows to cache product items by leaving out such highly
			 * dynamic content like stock levels which changes with each order.
			 *
			 * @param boolean Value of "1" to display stock levels, "0" to disable displaying them
			 * @since 2014.03
			 * @category User
			 * @category Developer
			 * @see client/html/catalog/detail/stock/enable
			 * @see client/html/catalog/stock/url/target
			 * @see client/html/catalog/stock/url/controller
			 * @see client/html/catalog/stock/url/action
			 * @see client/html/catalog/stock/url/config
			 */
			if( !empty( $products ) && $config->get( 'client/html/catalog/lists/stock/enable', true ) === true ) {
				$view->listStockUrl = $this->getStockUrl( $view, array_keys( $products ) );
			}


			$this->addMetaItem( $products, 'product', $this->expire, $this->tags );
			$this->addMetaList( array_keys( $products ), 'product', $this->expire );

			// Delete cache when products are added or deleted even when in "tag-all" mode
			$this->tags[] = 'product';

			$view->listParams = $this->getClientParams( $view->param() );
			$view->listPageCurr = $this->getProductListPage( $view );
			$view->listPageSize = $this->getProductListSize( $view );
			$view->listProductTotal = $this->getProductListTotal( $view );
			$view->listProductSort = $view->param( 'f_sort', 'relevance' );
			$view->listProductItems = $products;

			$this->cache = $view;
		}

		$expire = $this->expires( $this->expire, $expire );
		$tags = array_merge( $tags, $this->tags );

		return $this->cache;
	}


	/**
	 * Returns the URL to fetch the stock level details of the given products
	 *
	 * @param \Aimeos\MW\View\Iface $view View object
	 * @param array $productIds List of product IDs
	 * @return string Generated stock level URL
	 */
	protected function getStockUrl( \Aimeos\MW\View\Iface $view, array $productIds )
	{
		/** client/html/catalog/stock/url/target
		 * Destination of the URL where the controller specified in the URL is known
		 *
		 * The destination can be a page ID like in a content management system or the
		 * module of a software development framework. This "target" must contain or know
		 * the controller that should be called by the generated URL.
		 *
		 * @param string Destination of the URL
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stock/url/controller
		 * @see client/html/catalog/stock/url/action
		 * @see client/html/catalog/stock/url/config
		 */
		$stockTarget = $view->config( 'client/html/catalog/stock/url/target' );

		/** client/html/catalog/stock/url/controller
		 * Name of the controller whose action should be called
		 *
		 * In Model-View-Controller (MVC) applications, the controller contains the methods
		 * that create parts of the output displayed in the generated HTML page. Controller
		 * names are usually alpha-numeric.
		 *
		 * @param string Name of the controller
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stock/url/target
		 * @see client/html/catalog/stock/url/action
		 * @see client/html/catalog/stock/url/config
		*/
		$stockController = $view->config( 'client/html/catalog/stock/url/controller', 'catalog' );

		/** client/html/catalog/stock/url/action
		 * Name of the action that should create the output
		 *
		 * In Model-View-Controller (MVC) applications, actions are the methods of a
		 * controller that create parts of the output displayed in the generated HTML page.
		 * Action names are usually alpha-numeric.
		 *
		 * @param string Name of the action
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stock/url/target
		 * @see client/html/catalog/stock/url/controller
		 * @see client/html/catalog/stock/url/config
		*/
		$stockAction = $view->config( 'client/html/catalog/stock/url/action', 'stock' );

		/** client/html/catalog/stock/url/config
		 * Associative list of configuration options used for generating the URL
		 *
		 * You can specify additional options as key/value pairs used when generating
		 * the URLs, like
		 *
		 *  client/html/<clientname>/url/config = array( 'absoluteUri' => true )
		 *
		 * The available key/value pairs depend on the application that embeds the e-commerce
		 * framework. This is because the infrastructure of the application is used for
		 * generating the URLs. The full list of available config options is referenced
		 * in the "see also" section of this page.
		 *
		 * @param string Associative list of configuration options
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stock/url/target
		 * @see client/html/catalog/stock/url/controller
		 * @see client/html/catalog/stock/url/action
		 * @see client/html/url/config
		*/
		$stockConfig = $view->config( 'client/html/catalog/stock/url/config', array() );

		sort( $productIds );

		$params = array( 's_prodid' => implode( ' ', $productIds ) );
		return $view->url( $stockTarget, $stockController, $stockAction, $params, array(), $stockConfig );
	}
}
