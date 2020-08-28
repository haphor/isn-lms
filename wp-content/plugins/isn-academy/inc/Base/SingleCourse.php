<?php


namespace Inc\Base;


class SingleCourse extends BaseController
{
    private $tableName = 'wp_isn_academy_user';
    public $is_member = false;


    /**
     * Check if member is register
     *
     * @param int $postId
     * @param int $userId
     *
     * @return boolean
    */
    public static function isMember( int $postId, int $userId = 0  ) : bool
    {
        $userId = empty( $userId )
            ? get_current_user_id()
            : $userId;

        $membership = self::get( $postId, $userId );

        return $membership && $membership->user_id;
    }

    public static function get( $postId, $userId )
    {
        global $wpdb;

        $args = [
            'user_id' => $userId,
            'course_id' => $postId,
        ];

        $query = self::buildQuery( $args );

        return $wpdb->get_row( $query );
    }

    /**
     * Builds query based on given params
     *
     * @param array $args
     *
     * @return string
     */
    private static function buildQuery( $args = [] ) : string
    {
        global $wpdb;
        $tableName = 'wp_isn_academy_user';

        $select = 'SELECT ' . ( $args['select'] ?? '*' ) . ' FROM ' . $tableName;
        if( isset( $args['select'] ) ) {
            unset( $args['select'] );
        }

        $where = [];
        foreach( $args as $key => $value ) {
            if( $key === 'last_updated' ) {
                $where[] = $wpdb->prepare( $key . ' = %s', date( 'Y-m-d H:i:s', $value ) );
                continue;
            }

            if( is_array( $value ) ) {
                $where[] = $key . ' IN (' . implode( ',', (array) array_filter( array_map( 'intval', $value ) ) ) . ')';
                continue;
            }
            $where[] = is_numeric( $value )
                ? $wpdb->prepare( $key . ' = %d', $value )
                : $wpdb->prepare( $key . ' = %s', $value );
        }

        return $select . ' WHERE ' . implode( ' AND ', $where );
    }

    /**
     * Adds a membership
     *
     * @param int $parentId
     * @param int $postId
     * @param bool $confirmed
     *
     * @return int
     * @uses get_current_user_id()
     *
     */
    public function add( $parentId,  int $postId, bool $confirmed ) : void
    {
        global $wpdb;

        $args = [
            'course_id' => $postId,
            'parent_id' => $parentId,
            'user_id' => get_current_user_id(),
            'completed' => (int) $confirmed,
        ];

        $wpdb->insert( $this->tableName, $args );

        /*if( $result !== 0 ) {
            return '';
        }*/
    }

    public function update( $postId, $userId )
    {
        global $wpdb;

        $args = [
            'course_id' => $postId,
            'user_id' => $userId
        ];

        if( empty( $postId )
            || empty( $userId )
            || $wpdb->update( $this->tableName, [ 'completed' => 1 ], $args ) === false
        ) {
            error_log( 'Member status not updated' );
            return false;
        }

        return true;
    }


}