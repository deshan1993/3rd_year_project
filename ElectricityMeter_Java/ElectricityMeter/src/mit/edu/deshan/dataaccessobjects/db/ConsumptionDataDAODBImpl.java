package mit.edu.deshan.dataaccessobjects.db;

import mit.edu.deshan.domain.ConsumptionDataDomain;
import mit.edu.deshan.util.CommonUtil;
import java.sql.Connection;
import java.sql.PreparedStatement;
import mit.edu.deshan.dataaccessobjects.ConsumptionDataDAO;

//the database persistent implementation class of ConsumptionDataDAO
//in this implementation, student will be stored in db
public class ConsumptionDataDAODBImpl implements ConsumptionDataDAO {

    @Override
    public int saveConsumptionData(ConsumptionDataDomain consumptionData) throws Exception {
        int generatedPK = 0;
        Connection conn = null;
        PreparedStatement preparedStatement = null;
        String insertConsumptionDataSQL = DBConstants.Query.INSERT_CONSUMPTION_DATA;

        try {
            conn = DatabaseManager.getConnection();
            preparedStatement = conn.prepareStatement(insertConsumptionDataSQL);

            preparedStatement.setString(1, consumptionData.getConsumerId());
            preparedStatement.setDate(2, CommonUtil.getSQLDateFromUtilDate(consumptionData.getConsumptionDate()));
            preparedStatement.setTime(3, CommonUtil.getSQLTimeFromUtilDate(consumptionData.getConsumptionDate()));
            preparedStatement.setInt(4, consumptionData.getConsumptionAmount());
            

            generatedPK = preparedStatement.executeUpdate();

        } finally {
            //whatever happens in the try clauses, make sure to close all the opened connections/resources in the finally
            //this is a try- catch without a catch clause
            if (!(preparedStatement == null)) {
                preparedStatement.close();
            }
            if (!(conn == null)) {
                conn.close();
            }
        }
        return generatedPK;
    }

}
