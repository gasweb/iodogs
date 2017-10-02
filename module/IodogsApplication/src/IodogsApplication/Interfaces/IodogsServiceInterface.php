<?php
namespace IodogsApplication\Interfaces;


interface IodogsServiceInterface
{
    public function checkInstance($instance);
    public function getViewArray($Entity);
}