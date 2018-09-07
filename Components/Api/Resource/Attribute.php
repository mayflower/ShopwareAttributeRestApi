<?php

namespace ShopwareAttributeRestApi\Components\Api\Resource;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Model\QueryBuilder;
use Shopware\Components\Api\Resource\Resource;
use Shopware\Bundle\AttributeBundle\Service\CrudService;

class Attribute extends Resource
{

    /**
     * @var Shopware\Bundle\AttributeBundle\Service
     */
    private $crudService;

    /**
     * @param CrudService $crudService
     */
    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
    }

    /**
     * Return a list of entities
     *
     * @return array
     */
    public function getList()
    {
        return array('data' => [], 'total' => []);
    }


    /**
     * Read the given entity $id
     *
     * @param $id
     * @return array
     */
    public function getOne($id)
    {
        return ['getOne'];
    }

    /**
     * Create a new entity with $data
     *
     * @param $data
     * @return array
     */
    public function create($data)
    {
        return ['create'];
    }

    /**
     * Update a given entity $id with $data
     *
     * @param $id
     * @param $data
     * @return array
     */
    public function update($id, $data)
    {
        return ['update'];
    }

    /**
     * Delete the given entity
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return ['delete'];
    }

}
