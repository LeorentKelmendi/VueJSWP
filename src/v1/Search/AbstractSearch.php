<?php

namespace VuePress\V1\Search;

use VuePress\V1\Search\Posts;
use VuePress\V1\Search\Users;

require_once './././wp-config.php';

abstract class AbstractSearch
{

    /**
     * @var mixed
     */
    public $modelName;

    /**
     * @return mixed
     */
    public function search($query)
    {
        $buildQuery = $this->resolveSearchChild();
        global $wpdb;
        return $wpdb->get_results(sprintf($buildQuery, $query));
    }

    private function resolveSearchChild()
    {
        if ($this->modelName === Posts::class) {
            return "select * from wp_posts as p where p.post_title like '%%%s%%'";
        }

        if ($this->modelName === Users::class) {
            return "select * from wp_users as u where u.user_email like '%%%s%%'";
        }
    }
}
