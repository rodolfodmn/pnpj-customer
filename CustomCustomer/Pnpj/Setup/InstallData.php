<?php
namespace CustomCustomer\Pnpj;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		$eavSetup->addAttribute(
			\Magento\Customer\Model\Customer::ENTITY,
			'tipo_pessoa',
			[
				'label' => 'Tipo Pessoa',
				'type' => 'int',
				'input' => 'multiselect',
				'required' => false,
				'visible' => true,
				'user_defined' => true,
				'position' => 90,
				'system' => 0,
				'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
				'source' => 'Pnpj\Customer\Model\Entity\Attribute\Source\Pnpj'
			]
		);

		$tipoPessoa = $this->eavConfig->getAttribute(Customer::ENTITY, 'tipo_pessoa');
		$tipoPessoa->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);
		$tipoPessoa->save();

		$eavSetup->addAttribute(
			\Magento\Customer\Model\Customer::ENTITY,
			'inscricao_estadual',
			[
				'type'         => 'varchar',
				'label'        => 'Inscrição Estadual',
				'input'        => 'text',
				'required'     => false,
				'visible'      => true,
				'user_defined' => true,
				'position'     => 90,
				'system'       => 0,
			]
		);

		$inscricaoEstadual = $this->eavConfig->getAttribute(Customer::ENTITY, 'inscricao_estadual');
		$inscricaoEstadual->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);
		$inscricaoEstadual->save();

		$eavSetup->addAttribute(
			\Magento\Customer\Model\Customer::ENTITY,
			'tipo_compra',
			[
				'type' => 'int',
				'label' => 'Tipo Compra',
				'input' => 'multiselect',
				'required' => false,
				'visible' => true,
				'user_defined' => true,
				'position' => 90,
				'system' => 0,
				'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
				'source' => 'Pnpj\Customer\Model\Entity\Attribute\Source\SellTypes'
			]
		);

		$tipoCompra = $this->eavConfig->getAttribute(Customer::ENTITY, 'tipo_compra');
		$tipoCompra->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);
		$tipoCompra->save();
	}

}
