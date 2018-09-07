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
     * @param string $tableName
     *
     * @return array
     */
    public function getList($tableName)
    {
        $data = $this->crudService->getList($tableName);

        return array('data' => $data, 'total' => count($data));
    }


    /**
     * Read the given entity $id
     *
     * @param string $tableName
     * @param string $columnName
     * @return array
     */
    public function getOne($tableName, $columnName)
    {
        return $this->crudService->get($tableName, $columnName);
    }

    /**
     * Create a new entity with $data
     *
     * @param array $data
     *
     * @return null|\Shopware\Bundle\AttributeBundle\Service\ConfigurationStruct
     *
     * @throws \Exception
     */
    public function create(array $data)
    {
        $tableName = $data['tableName'];

        return $this->update($tableName, $data);
    }

    /**
     * Update a given entity $id with $data
     *
     * @param string $tableName
     * @param array $data
     * @return null|\Shopware\Bundle\AttributeBundle\Service\ConfigurationStruct
     * @throws \Exception
     */
    public function update($tableName, array $data)
    {
        $columnName  = $data['columnName'];
        $unifiedType = $data['unifiedType'];
        $attrData    = $data['data'];

        $this->crudService->update($tableName, $columnName, $unifiedType, $attrData);

        return $this->crudService->get($tableName, $columnName);
    }

    /**
     * Delete the given entity
     *
     * @param $tableName
     * @param $columnName
     * @return array
     * @throws \Exception
     */
    public function delete($tableName, $columnName)
    {
        return $this->crudService->delete($tableName, $columnName);
    }

}
