<?php
namespace Log;

use Common\AbstractDefaultFactory;

class DefaultFactory extends AbstractDefaultFactory
{
	protected function getNamespace(): string
	{
		return __NAMESPACE__;
	}
}