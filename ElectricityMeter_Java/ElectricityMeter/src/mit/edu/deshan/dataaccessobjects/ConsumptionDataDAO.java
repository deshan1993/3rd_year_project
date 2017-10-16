/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mit.edu.deshan.dataaccessobjects;

import mit.edu.deshan.domain.ConsumptionDataDomain;

public interface ConsumptionDataDAO {
    
    
    public int saveConsumptionData(ConsumptionDataDomain consumptionData)throws Exception;
    
    
    
}
