<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.05.18
 * Time: 12:54
 */

namespace ShopBundle\Admin;


use ShopBundle\Entity\Order;
use ShopBundle\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class OrderItemAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('product', ModelType::class, [
            'class' => Product::class,
            'property' => 'name',
            'label' => 'Товар'
        ]);
        $formMapper->add('count', NumberType::class, ['label' => 'Количество']);
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('product');
        $datagridMapper->add('count');
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
        $listMapper->add('product');
        $listMapper->add('count');
    }

}