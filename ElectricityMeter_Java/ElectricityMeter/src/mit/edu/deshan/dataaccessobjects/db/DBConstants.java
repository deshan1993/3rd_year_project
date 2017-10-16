/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mit.edu.deshan.dataaccessobjects.db;

/**
 *
 * @author nsenevirat001
 */
//marked as abstract to prevent others cretaing instances of it
//this class is used to contain db table names, field names and SQL syntax structre and SQl queries only
//cannot use an inteface, since there are inner classes used here
public abstract class DBConstants {
    


    // The SQL statements which are used in the system to save/retrieve data from database
    public static class Query {       

        //sql statemet to insert a student to database - the following SQL is constructed
        //no need to add the field id - it is auto generated       
        public static String INSERT_CONSUMPTION_DATA = new StringBuilder(INSERT_INTO)
                .append(EMPTY_SPACE).append(DBTables.CONSUMPTION_TABLE)
                .append(EMPTY_SPACE).append(LEFT_BRACKET)
                .append(EMPTY_SPACE).append(TableConsumptionColumns.CON_ID).append(SEPERATOR)
                .append(EMPTY_SPACE).append(TableConsumptionColumns.CONS_DATE).append(SEPERATOR)
                .append(EMPTY_SPACE).append(TableConsumptionColumns.CONS_TIME).append(SEPERATOR)
                .append(EMPTY_SPACE).append(TableConsumptionColumns.CONS_AMOUNT)
                .append(EMPTY_SPACE).append(RIGHT_BRACKET)
                .append(EMPTY_SPACE).append(VALUES).append(EMPTY_SPACE)
                .append(EMPTY_SPACE).append(LEFT_BRACKET)
                .append(EMPTY_SPACE).append("?,?,?,?")
                .append(EMPTY_SPACE).append(RIGHT_BRACKET)
                .toString();

        
    }

    // an inner class used to contain database table names
    public class DBTables {       
        
        public static final String CONSUMPTION_TABLE = "consumption_table";    
        
        private DBTables() {

        }
        
    }
    
    //The following classes REPRESENTS a mapping between the Domain Objects of the project and the db tables
    //like a a very basic ORM (Object Relational Mapping)
    //Some of industry scale used advanced ORM tools for java  - Hibernate,Spring DAO,Enterprise JavaBeans Entity Beans, MyBatis etc.
    
    // column names of consumption_table Table
    public class TableConsumptionColumns {

        public static final String CONS_NO = "cons_no";
        public static final String CON_ID = "con_id";
        public static final String CONS_DATE = "cons_date";
        public static final String CONS_TIME = "cons_time";
        public static final String CONS_AMOUNT = "cons_amount";

        private TableConsumptionColumns() {
        }
    }

    

   
    //constants used to construct SQL statements
    public static final String EMPTY_SPACE = " ";
    public static final String SELECT = "SELECT";
    public static final String INSERT = "INSERT";
    public static final String FROM = "FROM";
    public static final String WHERE = "WHERE";
    public static final String INTO = "INTO";
    public static final String VALUES = "VALUES";
    public static final String ORDER_BY = "ORDER BY";
    public static final String GROUP_BY = "GROUP BY";
    public static final String ASCENDING = "ASC";
    public static final String DECENDING = "DESC";
    public static final String LIMIT = "LIMIT";
    public static final String SEPERATOR = ",";
    public static final String ALL_FIELDS = "*";
    public static final String INSERT_INTO = "INSERT INTO";
    public static final String LEFT_BRACKET = "(";
    public static final String RIGHT_BRACKET = ")";
    public static final String UPDATE = "UPDATE";
    public static final String SET = "SET";
    public static final String EQUALS = "=";
    public static final String BETWEEN = "BETWEEN";
    public static final String AND = "AND";
    public static final String OR = "OR";
    public static final String COUNT = "COUNT";
    public static final String AS = "AS";
    public static final String DOT = ".";
    public static final String NOT_IN = "NOT IN";
    public static final String NOT_EQUALS = "!=";
    public static final String LESS_OR_EQUALS = "<=";
    public static final String GRATER_OR_EQUALS = ">=";
    public static final String DISTINCT = "DISTINCT";
    public static final String INNER_JOIN = "INNER JOIN";
    public static final String ON = "ON";
    public static final String LESSTHAN = "<";
    public static final String GRATERTHAN = ">";
    public static final String ISNULL = "IS NULL";
    public static final String ISNOTNULL = "IS NOT NULL";
    public static final String DELETE = "DELETE";
    public static final String LIKE = "LIKE";
    public static final String CONCAT = "CONCAT";
    public static final String UPPER = "UPPER";
    public static final String LOWER = "LOWER";
    public static final String CAST = "CAST";
    public static final String DATE = "DATE";
    public static final Object PLUS = "+";
    public static final String IN = "IN";
    public static final String SUM = "SUM";
    public static final String LEFT_JOIN = "LEFT JOIN";
    public static final String RIGHT_JOIN = "RIGHT JOIN";
    public static final String WHEN = "WHEN";
    public static final String CASE = "CASE";
    public static final String END = "END";
    public static final String THEN = "THEN";
    public static final String NOT = "NOT";

}
