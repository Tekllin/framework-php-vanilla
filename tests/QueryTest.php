<?php 
use PHPUnit\Framework\TestCase;
use Tekllin\Controller\Database;
class QueryTest extends TestCase {
    public function testMethod() {
        $db = new Database();
        $this->assertEquals("get", $db->get([])->getMethod());
        $this->assertEquals("delete", $db->delete([], true)->getMethod());
        $this->assertEquals("soft-delete", $db->delete([], false)->getMethod());
        $this->assertEquals("update", $db->update([])->getMethod());
        $this->assertEquals("post", $db->post([])->getMethod());
           
        
    }
    public function testFormat() {
        $db = new Database();
        
    
        $this->assertEquals("SELECT %s FROM %s WHERE %s ;", $db->get([])->getFormat());
        
        
        $this->assertEquals("INSERT INTO %s %s VALUES %s ;", $db->post([])->getFormat());

        
        $this->assertEquals("UPDATE %s SET %s WHERE %s ;", $db->update([])->getFormat());

        
        $this->assertEquals("DELETE FROM %s WHERE %s;", $db->delete([], true)->getFormat());

       
        $this->assertEquals("UPDATE %s SET %s WHERE %s ;", $db->delete([], false)->getFormat());
        
    }

}