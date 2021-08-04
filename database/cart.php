<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null; //if the connection is not set so return null
        $this->db = $db;
    }

    // insert ('userid' which comes from usertable,
    //        'itemid' which comes from product table, and  'cardid') into cart table
    public  function insertIntoCart($params = null, $table = "cart"){
        if ($this->db->con != null){
            if ($params != null){
                //syntax: Insert into tablename(column_name)values(0,1,2,...) 
                //note:table name and column name shouldbe same as we make in table
                // e.g: "Insert into cart(user_id) values (0)"

                // get table columns
                $columns = implode(',', array_keys($params)); 
        //implode function join elements of an array with a string(here we use comma)"
        //array_keys give user_id and item_id
        
                //if we want to display
                //print_r($columns);

                $values = implode(',' , array_values($params));
        //array_values give the values of user_id and item_id

                //if we want to display        
                //print_r($values);

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                //the sprintf() function writes a formatted string to a variable.
                //At the first % sign, arg1 is inserted,(%s used to insert string) 
                //at the second % sign, arg2 is inserted, etc. 

                //if we want to display
                //echo $query_string;

                // execute query
                $result = $this->db->con->query($query_string);
                //query() / mysqli_query() function performs a query against a database.
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into cart table when click on add to cart
    // button which we made in the topsale section
    public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
                //we dont specify hardqouted values(e.g 1,2 etc) bcz we want user to enter. 
                // quoted user_id and item_id are the names of the column
                // $userid and $itemid are the parameters which we pass in addtocart()
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
                //$_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
                //$_SERVER['PHP_SELF'] Returns the scurrently executing same page
            }
        }
    }

    // delete cart item using cart item id
    public function deleteCart($item_id = null, $table = 'cart'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_it of shopping cart list (to remove duplicate item)
    public function getCartId($cartArray = null, $key = "item_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";
            //in php we can execute multiple query at a time

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location :" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }


}