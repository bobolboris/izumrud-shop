<?php

namespace ShopBundle\Admin;

use ShopBundle\Entity\Category;
use ShopBundle\Entity\Photo;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Subcategory;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, ['label' => 'Название']);
        //        $formMapper->add('description', TextareaType::class, ['label' => 'Описание']);
        $formMapper->add('description', SimpleFormatterType::class,
            ['label' => 'Описание', 'format' => 'markdown', 'ckeditor_context' => 'default']);
        $formMapper->add('price', NumberType::class, ['label' => 'Цена']);
        $formMapper->add('photo', FileType::class,
            ['label' => 'Изображение', 'data_class' => null, 'required' => false]);

        $formMapper->add('subcategory', ModelType::class, [
                'class' => Subcategory::class,
                'property' => 'nameWithCategoryName',
                'label' => 'Категория - Подкатегория',
                'btn_add' => false
            ]);

        $formMapper->add('photos', ModelType::class, [
                'class' => Photo::class,
                'property' => 'url',
                'label' => 'Фотографии',
                'multiple' => true,
                'by_reference' => false,
                'btn_add' => 'Добавить'
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
        $datagridMapper->add('name');
        $datagridMapper->add('photo');
        $datagridMapper->add('description');
        $datagridMapper->add('category');
        $datagridMapper->add('subcategory');
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
        $listMapper->add('photo');
        $listMapper->add('name');
        $listMapper->add('category');
        $listMapper->add('subcategory');
        $listMapper->add('description');
        $listMapper->add('price');
    }


    public function preUpdate($object)
    {
        $this->DeletingHyphens($object);
        if (isset($object->photo)) {
            $this->manageFileUpload($object);
        } else {
            $em = $this->getModelManager()->getEntityManager(Product::class);
            $original = $em->getUnitOfWork()->getOriginalEntityData($object);
            $object->setPhoto($original['photo']);
        }
    }

    public function prePersist($object)
    {
        $this->DeletingHyphens($object);
        $this->manageFileUpload($object);
    }

    private function manageFileUpload($object)
    {
        if (isset($object->photo)) {
            $object->refreshUpdated();
        }
    }

    private function DeletingHyphens($object)
    {
        $description = $object->getDescription();
        for ($i = 0; $i < strlen($description); $i++) {
            if ($description[$i] == '\n' || $description == '\r') {
                $description[$i] = '';
            }
        }
        $object->setDescription($description);
    }
}