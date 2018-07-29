<?php

namespace ShopBundle\Admin;


use ShopBundle\Entity\City;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientAdmin extends AbstractAdmin
{
    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $years = [];
        for ($i = date("Y") - 16; $i >= 1920; $i--) {
            $years[] = $i;
        }
        $formMapper->add('secondName', TextType::class, ['label' => 'Фамилия']);
        $formMapper->add('firstName', TextType::class, ['label' => 'Имя']);
        $formMapper->add('fatherName', TextType::class, ['label' => 'Отчество']);
        $formMapper->add('birthday', DateType::class, ['label' => 'Дата рождения', 'years' => $years]);
        $formMapper->add('city', ModelType::class, [
            'class' => City::class,
            'property' => 'name',
            'label' => 'Город',
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
        $datagridMapper->add('secondName');
        $datagridMapper->add('firstName');
        $datagridMapper->add('fatherName');
        $datagridMapper->add('birthday');
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
        $listMapper->add('secondName');
        $listMapper->add('firstName');
        $listMapper->add('fatherName');
        $listMapper->add('birthday');
    }
}