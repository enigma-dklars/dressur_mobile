<?php

namespace ContainerXXAK4c3;

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    private $valueHolderd8b63 = null;
    private $initializercf5d4 = null;
    private static $publicProperties577c1 = [
        
    ];
    public function getConnection()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getConnection', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getConnection();
    }
    public function getMetadataFactory()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getMetadataFactory', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getMetadataFactory();
    }
    public function getExpressionBuilder()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getExpressionBuilder', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getExpressionBuilder();
    }
    public function beginTransaction()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'beginTransaction', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->beginTransaction();
    }
    public function getCache()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getCache', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getCache();
    }
    public function transactional($func)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'transactional', array('func' => $func), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->transactional($func);
    }
    public function wrapInTransaction(callable $func)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'wrapInTransaction', array('func' => $func), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->wrapInTransaction($func);
    }
    public function commit()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'commit', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->commit();
    }
    public function rollback()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'rollback', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->rollback();
    }
    public function getClassMetadata($className)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getClassMetadata', array('className' => $className), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getClassMetadata($className);
    }
    public function createQuery($dql = '')
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'createQuery', array('dql' => $dql), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->createQuery($dql);
    }
    public function createNamedQuery($name)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'createNamedQuery', array('name' => $name), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->createNamedQuery($name);
    }
    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->createNativeQuery($sql, $rsm);
    }
    public function createNamedNativeQuery($name)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->createNamedNativeQuery($name);
    }
    public function createQueryBuilder()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'createQueryBuilder', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->createQueryBuilder();
    }
    public function flush($entity = null)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'flush', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->flush($entity);
    }
    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->find($className, $id, $lockMode, $lockVersion);
    }
    public function getReference($entityName, $id)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getReference($entityName, $id);
    }
    public function getPartialReference($entityName, $identifier)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getPartialReference($entityName, $identifier);
    }
    public function clear($entityName = null)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'clear', array('entityName' => $entityName), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->clear($entityName);
    }
    public function close()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'close', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->close();
    }
    public function persist($entity)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'persist', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->persist($entity);
    }
    public function remove($entity)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'remove', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->remove($entity);
    }
    public function refresh($entity, ?int $lockMode = null)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'refresh', array('entity' => $entity, 'lockMode' => $lockMode), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->refresh($entity, $lockMode);
    }
    public function detach($entity)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'detach', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->detach($entity);
    }
    public function merge($entity)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'merge', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->merge($entity);
    }
    public function copy($entity, $deep = false)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->copy($entity, $deep);
    }
    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->lock($entity, $lockMode, $lockVersion);
    }
    public function getRepository($entityName)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getRepository', array('entityName' => $entityName), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getRepository($entityName);
    }
    public function contains($entity)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'contains', array('entity' => $entity), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->contains($entity);
    }
    public function getEventManager()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getEventManager', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getEventManager();
    }
    public function getConfiguration()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getConfiguration', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getConfiguration();
    }
    public function isOpen()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'isOpen', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->isOpen();
    }
    public function getUnitOfWork()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getUnitOfWork', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getUnitOfWork();
    }
    public function getHydrator($hydrationMode)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getHydrator($hydrationMode);
    }
    public function newHydrator($hydrationMode)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->newHydrator($hydrationMode);
    }
    public function getProxyFactory()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getProxyFactory', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getProxyFactory();
    }
    public function initializeObject($obj)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'initializeObject', array('obj' => $obj), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->initializeObject($obj);
    }
    public function isUninitializedObject($obj): bool
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'isUninitializedObject', array('obj' => $obj), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->isUninitializedObject($obj);
    }
    public function getFilters()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'getFilters', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->getFilters();
    }
    public function isFiltersStateClean()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'isFiltersStateClean', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->isFiltersStateClean();
    }
    public function hasFilters()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'hasFilters', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return $this->valueHolderd8b63->hasFilters();
    }
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;
        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);
        $instance->initializercf5d4 = $initializer;
        return $instance;
    }
    public function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, ?\Doctrine\Common\EventManager $eventManager = null)
    {
        static $reflection;
        if (! $this->valueHolderd8b63) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderd8b63 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
        }
        $this->valueHolderd8b63->__construct($conn, $config, $eventManager);
    }
    public function & __get($name)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__get', ['name' => $name], $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        if (isset(self::$publicProperties577c1[$name])) {
            return $this->valueHolderd8b63->$name;
        }
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderd8b63;
            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }
        $targetObject = $this->valueHolderd8b63;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();
        return $returnValue;
    }
    public function __set($name, $value)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__set', array('name' => $name, 'value' => $value), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderd8b63;
            $targetObject->$name = $value;
            return $targetObject->$name;
        }
        $targetObject = $this->valueHolderd8b63;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();
        return $returnValue;
    }
    public function __isset($name)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__isset', array('name' => $name), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderd8b63;
            return isset($targetObject->$name);
        }
        $targetObject = $this->valueHolderd8b63;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();
        return $returnValue;
    }
    public function __unset($name)
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__unset', array('name' => $name), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderd8b63;
            unset($targetObject->$name);
            return;
        }
        $targetObject = $this->valueHolderd8b63;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }
    public function __clone()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__clone', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        $this->valueHolderd8b63 = clone $this->valueHolderd8b63;
    }
    public function __sleep()
    {
        $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, '__sleep', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
        return array('valueHolderd8b63');
    }
    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }
    public function setProxyInitializer(?\Closure $initializer = null): void
    {
        $this->initializercf5d4 = $initializer;
    }
    public function getProxyInitializer(): ?\Closure
    {
        return $this->initializercf5d4;
    }
    public function initializeProxy(): bool
    {
        return $this->initializercf5d4 && ($this->initializercf5d4->__invoke($valueHolderd8b63, $this, 'initializeProxy', array(), $this->initializercf5d4) || 1) && $this->valueHolderd8b63 = $valueHolderd8b63;
    }
    public function isProxyInitialized(): bool
    {
        return null !== $this->valueHolderd8b63;
    }
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderd8b63;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
