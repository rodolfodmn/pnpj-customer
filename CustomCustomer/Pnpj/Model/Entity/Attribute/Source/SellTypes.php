<?php

namespace CustomCustomer\Pnpj\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class SellTypes extends AbstractSource
{
	public function getAllOptions()
	{
		return [
			'uso_proprio' => [
				'label' => 'Uso próprio',
				'value' => '1'
			],
			'revenda' => [
				'label' => 'Revenda',
				'value' => '2'
			]
		];
	}
}
