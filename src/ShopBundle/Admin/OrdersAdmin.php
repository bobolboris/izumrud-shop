<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.05.18
 * Time: 23:37
 */

namespace ShopBundle\Admin;

use ShopBundle\Entity\Client;
use ShopBundle\Entity\OrderItem;
use ShopBundle\Entity\OrderStatuses;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OrdersAdmin extends AbstractAdmin
{
    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('products', ModelType::class, [
            'class' => OrderItem::class,
            'multiple' => true,
            'btn_add' => 'Добавить',
            'by_reference' => false,
            'label' => 'Товары'
        ]);
        $formMapper->add('date', DateTimeType::class, ['label' => 'Дата заказа']);
        $formMapper->add('status', ModelType::class, [
            'class' => OrderStatuses::class,
            'label' => 'Статус заказа',
            'btn_add' => false
        ]);
        $formMapper->add('client', ModelType::class, [
            'class' => Client::class,
            'label' => 'Клиент',
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
        $datagridMapper->add('date');
        $datagridMapper->add('products');
        $datagridMapper->add('status');
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
        $listMapper->add('date');
        $listMapper->add('products');
        $listMapper->add('status');
    }
}