<div class="col-md-12">
    <ul class="pagination">
        <?php foreach ($paging->data as $key => $value) {
            $activeClass = "";
            if($value['isActive'] == 1) {
                $activeClass = "active";
            }
            echo "<li class='page-item {$activeClass}'><a class='page-link' href='index.php?module={$module}&action=list&page={$value['page']}' title=''>{$value['page']}</a></li>";
        } ?>
    </ul>
</div>