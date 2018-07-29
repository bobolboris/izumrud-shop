<?php

namespace ShopBundle\Admin;

use ShopBundle\Entity\Product;
use ShopBundle\Entity\SpecificationNames;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductSpecificationAdmin extends AbstractAdmin
{
    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', ModelType::class, [
            'class' => SpecificationNames::class,
            'property' => 'name',
            'label' => 'Название'
        ]);
        $formMapper->add('value', TextType::class, ['label' => 'Значение']);
        $formMapper->add('product', ModelType::class, [
            'class' => Product::class,
            'property' => 'name',
            'label' => 'Товар',
            'btn_add' => false
        ]);
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('name');
        $datagridMapper->add('value');
        $datagridMapper->add('product');
    }


    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('name');
        $listMapper->add('value');
        $listMapper->add('product');
    }
}