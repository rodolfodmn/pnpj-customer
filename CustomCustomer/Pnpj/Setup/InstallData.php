<?php
namespace CustomCustomer\Pnpj\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

	/**
	 * @var CustomerSetupFactory
	 */
	protected $customerSetupFactory;

	/**
	 * @var AttributeSetFactory
	 */
	protected $attributeSetFactory;

	/**
	 * @param CustomerSetupFactory $customerSetupFactory
	 * @param AttributeSetFactory $attributeSetFactory
	 */
	public function __construct(
		CustomerSetupFactory $customerSetupFactory,
		AttributeSetFactory $attributeSetFactory
	) {
		$this->customerSetupFactory = $customerSetupFactory;
		$this->attributeSetFactory = $attributeSetFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

		$customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
		$attributeSetId = $customerEntity->getDefaultAttributeSetId();

		$attributeSet = $this->attributeSetFactory->create();
		$attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

		$customerSetup->addAttribute(Customer::ENTITY, 'tipo_pessoa', [
			'label' => 'Tipo Pessoa',
			'type' => 'int',
			'input' => 'multiselect',
			'required' => false,
			'visible' => true,
			'user_defined' => true,
			'sort_order' => 79,
			'position' => 79,
			'system' => 0,
			'is_used_in_grid' => true,
			'is_visible_in_grid' => true,
			'is_html_allowed_on_front' => false,
			'visible_on_front' => true,
			'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
			'source' => 'Pnpj\Customer\Model\Entity\Attribute\Source\Pnpj'
		]);

		$attribute = $customerSetup->getEavConfig()
							 ->getAttribute(Customer::ENTITY, 'tipo_pessoa')
							 ->addData([
								 'attribute_set_id' => $attributeSetId,
								 'attribute_group_id' => $attributeGroupId,
								 'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
							 ]);

		$attribute->save();

		$attributeSet = $this->attributeSetFactory->create();
		$attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

		$customerSetup->addAttribute(Customer::ENTITY, 'inscricao_estadual', [
			'label' => 'Inscrição Estadual',
			'type' => 'text',
			'input' => 'text',
			'required' => false,
			'visible' => true,
			'user_defined' => true,
			'sort_order' => 78,
			'position' => 78,
			'system' => 0,
			'is_used_in_grid' => true,
			'is_visible_in_grid' => true,
			'is_html_allowed_on_front' => false,
			'visible_on_front' => true
		]);

		$attribute = $customerSetup->getEavConfig()
							 ->getAttribute(Customer::ENTITY, 'inscricao_estadual')
							 ->addData([
								 'attribute_set_id' => $attributeSetId,
								 'attribute_group_id' => $attributeGroupId,
								 'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
							 ]);

		$attribute->save();


		$attributeSet = $this->attributeSetFactory->create();
		$attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

		$customerSetup->addAttribute(Customer::ENTITY, 'tipo_compra', [
			'type' => 'text',
			'label' => 'Tipo Compra',
			'input' => 'text',
			'required' => false,
			'visible' => true,
			'user_defined' => true,
			'sort_order' => 78,
			'position' => 78,
			'system' => 0,
			'is_used_in_grid' => true,
			'is_visible_in_grid' => true,
			'is_html_allowed_on_front' => false,
			'visible_on_front' => true,
			'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
			'source' => 'Pnpj\Customer\Model\Entity\Attribute\Source\SellTypes'
		]);

		$attribute = $customerSetup->getEavConfig()
							 ->getAttribute(Customer::ENTITY, 'tipo_compra')
							 ->addData([
								 'attribute_set_id' => $attributeSetId,
								 'attribute_group_id' => $attributeGroupId,
								 'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
							 ]);

		$attribute->save();
	}

}
