<?php


namespace test\HealthCheckBundle\Service;

use test\HealthCheckBundle\Entity\HealthDataInterface;

interface HealthInterface
{
    public const TAG = 'health.service';

    public function getName(): string;
    public function getHealthInfo(): HealthDataInterface;
}