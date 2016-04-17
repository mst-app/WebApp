<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'APIBundle\Repository\LocationRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'name',
   'fieldName' => 'name',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'x',
   'fieldName' => 'x',
   'type' => 'decimal',
   'precision' => 10,
   'scale' => 0,
  ));
$metadata->mapField(array(
   'columnName' => 'y',
   'fieldName' => 'y',
   'type' => 'decimal',
   'precision' => 10,
   'scale' => 0,
  ));
$metadata->mapField(array(
   'columnName' => 'city',
   'fieldName' => 'city',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'zip',
   'fieldName' => 'zip',
   'type' => 'integer',
  ));
$metadata->mapField(array(
   'columnName' => 'perturbation',
   'fieldName' => 'perturbation',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);