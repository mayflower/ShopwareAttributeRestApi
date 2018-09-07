<?php

namespace Shopware\Components\Api\Resource;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Model\QueryBuilder;
use Shopware\Components\Api\Resource\Resource;

class AttributeModel extends Resource
{
    /**
     * Return a list of entities
     *
     * @param $offset
     * @param $limit
     * @param $filter
     * @param $sort
     *
     * @return array
     */
    public function getList($offset, $limit, $filter, $sort)
    {
        $builder = $this->getBaseQuery();
        $builder = $this->addQueryLimit($builder, $offset, $limit);

        if (!empty($filter)) {
            $builder->addFilter($filter);
        }
        if (!empty($sort)) {
            $builder->addOrderBy($sort);
        }

        $query = $builder->getQuery();

        $query->setHydrationMode($this->getResultMode());

        $paginator = new Paginator($query);

        $totalResult = $paginator->count();

        $result = $paginator->getIterator()->getArrayCopy();

        return array('data' => $result, 'total' => $totalResult);
    }


    /**
     * Read the given entity $id
     *
     * @param $id
     *
     * @return \AttributeModel
     *
     * @throws ApiException\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($id)
    {
        $builder = $this->getBaseQuery();

        $builder->where('attributemodel.id = :id')
            ->setParameter('id', $id);

        /** @var $model \AttributeModel */
        $model = $builder->getQuery()->getOneOrNullResult($this->getResultMode());

        if (!$model) {
            throw new ApiException\NotFoundException("AttributeModel by id $id not found");
        }

        return $model;
    }

    /**
     * Create a new entity with $data
     *
     * @param $data
     *
     * @return \AttributeModel
     *
     * @throws ApiException\NotFoundException
     * @throws ApiException\OrmException
     * @throws ApiException\ParameterMissingException
     * @throws ApiException\ValidationException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function create($data)
    {
        $data = $this->prepareData($data);
        $model = new \AttributeModel();
        $model->fromArray($data);

        $violations = $this->getManager()->validate($model);

        if ($violations->count() > 0) {
            throw new ApiException\ValidationException($violations);
        }

        $this->getManager()->persist($model);
        $this->flush();

        return $model;
    }

    /**
     * Update a given entity $id with $data
     *
     * @param $id
     * @param $data
     *
     * @return \AttributeModel
     *
     * @throws ApiException\NotFoundException
     * @throws ApiException\OrmException
     * @throws ApiException\ParameterMissingException
     * @throws ApiException\ValidationException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update($id, $data)
    {
        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $model \AttributeModel */
        $model = $this->getManager()->find('AttributeModel', $id);

        if (!$model) {
            throw new ApiException\NotFoundException("attributemodel by id $id not found");
        }

        $data = $this->prepareData($data);

        $model->fromArray($data);

        $violations = $this->getManager()->validate($model);
        if ($violations->count() > 0) {
            throw new ApiException\ValidationException($violations);
        }

        $this->flush();

        return $model;
    }

    /**
     * Delete the given entity
     *
     * @param $id
     *
     * @return \AttributeModel
     *
     * @throws ApiException\NotFoundException
     * @throws ApiException\OrmException
     * @throws ApiException\ParameterMissingException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete($id)
    {
        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $model \AttributeModel */
        $model = $this->getManager()->find('AttributeModel', $id);

        if (!$model) {
            throw new ApiException\NotFoundException("attributemodel by id $id not found");
        }

        $this->getManager()->remove($model);
        $this->flush();

        return $model;
    }


    /**
     * Here the data is prepared for automatic setting
     */
    protected function prepareData($data)
    {
        return $data;
    }

    /**
     * @param QueryBuilder $builder
     * @param              $offset
     * @param null         $limit
     *
     * @return QueryBuilder
     */
    protected function addQueryLimit(QueryBuilder $builder, $offset, $limit = null)
    {
        $builder->setFirstResult($offset)
            ->setMaxResults($limit);

        return $builder;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder|QueryBuilder
     */
    protected function getBaseQuery()
    {
        $builder = $this->getManager()->createQueryBuilder();
        $builder->select(array('attributemodel'))
            ->from('AttributeModel', 'attributemodel');

        return $builder;
    }
}
