<?php

namespace Craue\TwigExtensionsBundle\Tests\Twig\Extension;

use Craue\TwigExtensionsBundle\Tests\TwigBasedTestCase;

/**
 * @group integration
 *
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2012 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class StringHelperExtensionIntegrationTest extends TwigBasedTestCase {

	public function testAddTrailingDot() {
		$cases = array(
			array(
				'value' => 'This text should end with a dot',
				'result' => 'This text should end with a dot.',
			),
			array(
				'value' => 'This text should end with exactly one dot.',
				'result' => 'This text should end with exactly one dot.',
			),
		);

		foreach ($cases as $index => $case) {
			$this->assertSame($case['result'],
					$this->getTwig()->render('IntegrationTestBundle:StringHelper:trailingDot.html.twig', array(
						'value' => $case['value'],
					)),
					'test case with index '.$index);
		}
	}

}
