<?php

class Shopware_Controllers_Api_AttributeModel extends Shopware_Controllers_Api_Rest
{
    /**
     * @var \Shopware\Components\Api\Resource\AttributeModel     */
    protected $resource = null;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('AttributeModel');
    }

    /**
     * Get list of entities
     *
     * GET /api/attributemodel/
     */
    public function indexAction()
    {
        $limit  = $this->Request()->getParam('limit', 1000);
        $offset = $this->Request()->getParam('start', 0);
        $sort   = $this->Request()->getParam('sort', array());
        $filter = $this->Request()->getParam('filter', array());

        $result = $this->resource->getList($offset, $limit, $filter, $sort);

        $this->View()->assign($result);
        $this->View()->assign('success', true);
    }

    /**
     * Get one entity
     *
     * GET /api/attributemodel/{id}
     */
    public function getAction()
    {
        $id = $this->Request()->getParam('id');

        $entity = $this->resource->getOne($id);

        $this->View()->assign('data', $entity);
        $this->View()->assign('success', true);
    }

    /**
     * Create new entity
     *
     * POST /api/attributemodel}
     */
    public function postAction()
    {
        $entity = $this->resource->create($this->Request()->getPost());

        $location = $this->apiBaseUrl . 'attributemodel/' . $entity->getId();
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
     * PUT /api/attributemodel/{id}
     */
    public function putAction()
    {
        $id = $this->Request()->getParam('id');
        $params = $this->Request()->getPost();


        $entity = $this->resource->update($id, $params);

        $location = $this->apiBaseUrl . 'attributemodel/' . $entity->getId();
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
     * DELETE /api/attributemodel/{id}
     */
    public function deleteAction()
    {
        $id = $this->Request()->getParam('id');

        $this->resource->delete($id);

        $this->View()->assign(array('success' => true));
    }
}
