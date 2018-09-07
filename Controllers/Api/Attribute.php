<?php

class Shopware_Controllers_Api_Attribute extends Shopware_Controllers_Api_Rest
{

    /**
     * @var \ShopwareAttributeRestApi\Components\Api\Resource\Attribute
     */
    protected $resource = null;

    public function init()
    {
        try {
            $this->resource = \Shopware\Components\Api\Manager::getResource('Attribute');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get list of entities
     *
     * GET /api/attribute?{tableName}
     */
    public function indexAction()
    {
        $tableName = $this->Request()->getParam('table_name');

        $result = $this->resource->getList($tableName);

        $this->View()->assign($result);
        $this->View()->assign('success', true);
    }

    /**
     * Get one entity
     *
     * GET /api/attribute/{tableName}?column_name={columnName}
     */
    public function getAction()
    {
        $tableName  = $this->Request()->getParam('id');
        $columnName = $this->Request()->getParam('column_name');

        $entity = $this->resource->getOne($tableName, $columnName);

        $this->View()->assign('data', $entity);
        $this->View()->assign('success', true);
    }

    /**
     * Create new entity
     *
     * POST /api/attribute
     *
     * @throws Exception
     */
    public function postAction()
    {
        $entity = $this->resource->create($this->Request()->getPost());

        $location = $this->apiBaseUrl . 'attribute/' . $entity->getTableName() . '?column_name=' . $entity->getColumnName();
        $data = array(
            'id'       => $entity->getId(),
            'location' => $location
        );

        $this->View()->assign(array('success' => true, 'data' => $data));
        $this->Response()->setHeader('Location', $location);
    }

    /**
     * Update entity
     *
     * PUT /api/attribute/{tableName}
     * @throws Exception
     */
    public function putAction()
    {
        $tableName = $this->Request()->getParam('id');
        $data      = $this->Request()->getPost();


        $entity = $this->resource->update($tableName, $data);

        $location = $this->apiBaseUrl . 'attribute/' . $entity->getTableName() . '?column_name=' . $entity->getColumnName();
        $data = array(
            'id'       => $entity->getId(),
            'location' => $location
        );

        $this->View()->assign(array('success' => true, 'data' => $data));
        $this->Response()->setHeader('Location', $location);
    }

    /**
     * Delete entity
     *
     * DELETE /api/attribute/{tableName}?column_name={columnName}
     *
     * @throws Exception
     */
    public function deleteAction()
    {
        $tableName  = $this->Request()->getParam('id');
        $columnName = $this->Request()->getParam('column_name');

        $this->resource->delete($tableName, $columnName);

        $this->View()->assign(array('success' => true));
    }
}
