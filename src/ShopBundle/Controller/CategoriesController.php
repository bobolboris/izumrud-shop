<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends BaseController
{
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoriesAction($id)
    {
        $em = $this->getDoctrine();
        $target = $em->getRepository("ShopBundle:Category")->find($id);
        if ($target == null) {
            throw new NotFoundHttpException();
        }

        $subcategories = $target->getSubcategories();
        $products = $em->getRepository("ShopBundle:Product")->findByWithLimit(["category" => $target->getId()], 15);
        $result = $this->baseLoad();
        $result['target'] = $target;
        $result['products'] = $products;
        $result['category'] = null;
        $result['subcategories'] = (count($subcategories) == 0) ? [] : $subcategories;
        $result['stamp'] = 1;
        $result['targetId'] = $target->getId();
        return $this->render('ShopBundle:default:categories.html.twig', $result);
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function subcategoriesAction($id)
    {
        $em = $this->getDoctrine();
        $target = $em->getRepository("ShopBundle:Subcategory")->find($id);
        if ($target == null) {
            throw new NotFoundHttpException();
        }
        $category = $target->getCategory();
        $products = $em->getRepository("ShopBundle:Product")->findByWithLimit(["subcategory" => $target->getId()], 15);
        $result = $this->baseLoad();
        $result['target'] = $target;
        $result['products'] = $products;
        $result['subcategories'] = [];
        $result['category'] = $category;
        $result['stamp'] = 0;
        $result['targetId'] = $target->getId();
        return $this->render('ShopBundle:default:categories.html.twig', $result);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function loadMoreProductsAction(Request $request)
    {
        $stamp = $request->get('stamp');
        if (!isset($stamp)) {
            return new JsonResponse(['ok' => false]);
        }

        $targetId = $request->get('targetId');
        if (!isset($targetId)) {
            return new JsonResponse(['ok' => false]);
        }

        $maxId = $request->get('maxId');
        if (!isset($maxId)) {
            return new JsonResponse(['ok' => false]);
        }

        $criterion = ($stamp == 1) ? "category" : "subcategory";
        $products =
            $this->getDoctrine()->getRepository("ShopBundle:Product")->findByWithLimit([$criterion => $targetId], 15,
                $maxId);

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]->setCategory(null)->setSubcategory(null)->setPhotos(null)->setProductSpecifications(null);
        }


        return new JsonResponse([
            'ok' => true,
            'length' => count($products),
            'products' => $this->container->get('serializer')->normalize($products)
        ]);
    }
}