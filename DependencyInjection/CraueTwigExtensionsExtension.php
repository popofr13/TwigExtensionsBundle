<?php

namespace Craue\TwigExtensionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Registration of the bundle via DI.
 *
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2012 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class CraueTwigExtensionsExtension extends Extension {

	/**
	 * {@inheritDoc}
	 */
	public function load(array $config, ContainerBuilder $container) {
		$processor = new Processor();
		$config = $processor->processConfiguration(new Configuration(), $config);

		$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

		$availableExtensions = array(
			'ArrayHelperExtension',
			'ChangeLanguageExtension',
			'DecorateEmptyValueExtension',
			'FormatDateTimeExtension',
			'FormatNumberExtension',
			'FormExtension',
			'StringHelperExtension',
		);

		if (!empty($config['enable_only'])) {
			$loadExtensions = array();
			foreach ($config['enable_only'] as $ext) {
				if (!in_array($ext, $availableExtensions)) {
					throw new \InvalidArgumentException(sprintf('Extension with name "%s" is invalid.', $ext));
				}
				$loadExtensions[] = $ext;
			}
		} else {
			$loadExtensions = $availableExtensions;
		}

		foreach ($loadExtensions as $ext) {
			$loader->load(sprintf('twig/%s.xml', $ext));
		}
	}

}
