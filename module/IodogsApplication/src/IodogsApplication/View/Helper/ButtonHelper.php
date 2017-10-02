<?php
namespace IodogsApplication\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ButtonHelper extends AbstractHelper
{  
	public function showAddButton($href, $title)
	{
		if(!empty($href) && !empty($title))
		{
			?>
			<div class="right">
			<a class="btn btn-success btn-sm" href="<?=$href ?>">
			<span class="glyphicon glyphicon-plus"></span>
			<?=$title ?>
			</a>
			</div>
<?php
		}		
	}
}