<?php

class Shopware_Controllers_Api_Attribute extends Shopware_Controllers_Api_Rest
{

    /**
     * @var \Shopware\Components\Api\Resource\Attribute
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
     * GET /api/attribute/
     */
    public function indexAction()
    {
        $result = $this->resource->getList();

        $this->View()->assign($result);
        $this->View()->assign('success', true);
    }

    /**
     * Get one entity
     *
     * GET /api/attribute/{id}
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
     * POST /api/attribute}
     */
    public function postAction()
    {
        $entity = $this->resource->create($this->Request()->getPost());

        $location = $this->apiBaseUrl . 'attribute/' . $entity->getId();
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
     * PUT /api/attribute/{id}
     */
    public function putAction()
    {
        $id = $this->Request()->getParam('id');
        $params = $this->Request()->getPost();


        $entity = $this->resource->update($id, $params);

        $location = $this->apiBaseUrl . 'attribute/' . $entity->getId();
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
     * DELETE /api/attribute/{id}
     */
    public function deleteAction()
    {
        $id = $this->Request()->getParam('id');

        $this->resource->delete($id);

        $this->View()->assign(array('success' => true));
    }
}
