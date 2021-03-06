<?php
class CustomQueriesTest extends SetupTests
{
    public function __destruct()
    {
        $this->connection = null;
    }

    public function select($specify)
    {
        return $this->connection->query("SELECT * FROM custom_query $specify")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function testRetrieveOne()
    {
        $entity_manager = new DatabaseTalker(array('connection' => $this->connection));
        $elements = $entity_manager->retrieve('SELECT field FROM custom_query WHERE custom_query_id = 1');
        $this->assertEquals('some field value', $elements[0]['field']);
    }

    public function testRetrieveTwo()
    {
        $entity_manager = new DatabaseTalker(array('connection' => $this->connection));
        $elements = $entity_manager->retrieve('SELECT field FROM custom_query WHERE custom_query_id = 2');
        $this->assertEquals('value some field', $elements[0]['field']);
    }

    public function testQueryOne()
    {
        $entity_manager = new DatabaseTalker(array('connection' => $this->connection));
        $entity_manager->query("INSERT INTO custom_query (field) VALUES ('new value')");
        $elements_row = $this->select('WHERE custom_query_id = 3');
        $this->assertEquals('new value', $elements_row[0]['field']);
    }

    public function testQueryTwo()
    {
        $entity_manager = new DatabaseTalker(array('connection' => $this->connection));
        $entity_manager->query("INSERT INTO custom_query (field) VALUES ('value new')");
        $elements_row = $this->select('WHERE custom_query_id = 4');
        $this->assertEquals('value new', $elements_row[0]['field']);
    }
}
