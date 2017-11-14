<?php

echo get_ol($competencies);

function get_ol($array, $child = false) {
    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item['id'] . '">';
            $str .= '<div>' . $item['name'] . '</div>';
            // if have children
            if (isset($item['children']) && count($item['children'])) {
                $str .= get_ol($item['children'], TRUE);
            }
            $str .= '</li>' . PHP_EOL;
        }
        $str .= '</ol>' . PHP_EOL;
    }
    return $str;
}

?>
<script>
    $(document).ready(function(){

		$('.sortable').nestedSortable({
			handle: 'div',
			items: 'li',
			toleranceElement: '> div', 
                        maxLevels: 2,
		});

	});
    </script>