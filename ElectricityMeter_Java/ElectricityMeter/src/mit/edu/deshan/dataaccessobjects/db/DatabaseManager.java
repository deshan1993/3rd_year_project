package mit.edu.deshan.dataaccessobjects.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseManager {
	
	// JDBC driver name and database URL
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	static final String DB_URL = "jdbc:mysql://localhost:3306/electricity_data";

	//  Database credentials
	static final String USER = "root";
	static final String PASS = "";
	
	public static Connection getConnection() {
		try{
                    //- this is just to check if the mysql jdbs driver in the classpath
                    //because its a thrid party .jar(java archive) file
                    //if the following line fails - it will throw ClassNotFoundException - easy to find the reason to fail
		    Class.forName("com.mysql.jdbc.Driver"); 
                    
                    
		    return DriverManager.getConnection(DB_URL, USER, PASS);
                    
		}catch(ClassNotFoundException ce){
			ce.printStackTrace();
			System.out.println("The connection failed -  com.mysql.jdbc.Driver is not in classpath, check if jar is available!");
		}catch(SQLException se){
			se.printStackTrace();
			System.out.println("The connection failed - check the connection url parameters!");
		}finally{
                        //the following line will always be excuted
			System.out.println("IN FINALLY ");
		}
		return null;
	}

}
