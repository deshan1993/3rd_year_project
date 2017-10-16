/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mit.edu.deshan.job;

import java.util.Calendar;
import java.util.Random;
import java.util.TimerTask;
import javax.swing.JLabel;
import javax.swing.JSpinner;
import javax.swing.JTextField;
import mit.edu.deshan.dataaccessobjects.ConsumptionDataDAO;
import mit.edu.deshan.dataaccessobjects.db.ConsumptionDataDAODBImpl;
import mit.edu.deshan.domain.ConsumptionDataDomain;
import mit.edu.deshan.util.CommonUtil;

/**
 *
 * @author Deshan Hasantha
 */
public class RandomDataEntryNewJob extends TimerTask {

    private String consumerId;

    private int reading;
    
    private int noOfReadingsTaken=0;

    private javax.swing.JTextField jTextFieldMeterReading;

    private javax.swing.JLabel jLabelNoOfReadingsTaken;
    
    private javax.swing.JLabel jLabelLastReadingTakenAt;

    @Override
    public void run() {

        Calendar cal = Calendar.getInstance();

        ConsumptionDataDAO consumptionDataDAO = new ConsumptionDataDAODBImpl();

        //add code to generate random data  and save data here
        ConsumptionDataDomain consumptionData = new ConsumptionDataDomain();

        Random random = new Random();
        consumptionData.setConsumerId(this.consumerId);
        int randomValue = random.nextInt((10 - 1) + 1) + 1;    
        this.reading = this.reading + randomValue;
        consumptionData.setConsumptionAmount(randomValue);
        consumptionData.setConsumptionDate(cal.getTime());
        this.getjTextFieldMeterReading().setText(Integer.toString(reading));

        try {
            //increent noOfReadingsTaken by 1 when inserting to db
            this.noOfReadingsTaken++;
            this.jLabelNoOfReadingsTaken.setText("No of readings taken:- "  + Integer.toString(noOfReadingsTaken));
            this.jLabelLastReadingTakenAt.setText("Last reading taken at:- " + CommonUtil.getFormattedDateTime(Calendar.getInstance().getTime()));
            consumptionDataDAO.saveConsumptionData(consumptionData);

        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    public String getConsumerId() {
        return consumerId;
    }

    public void setConsumerId(String consumerId) {
        this.consumerId = consumerId;
    }

    public int getReading() {
        return reading;
    }

    public void setReading(int reading) {
        this.reading = reading;
    }

    public JTextField getjTextFieldMeterReading() {
        return jTextFieldMeterReading;
    }

    public void setjTextFieldMeterReading(JTextField jTextFieldMeterReading) {
        this.jTextFieldMeterReading = jTextFieldMeterReading;
    }

    public JLabel getjLabelNoOfReadingsTaken() {
        return jLabelNoOfReadingsTaken;
    }

    public void setjLabelNoOfReadingsTaken(JLabel jLabelNoOfReadingsTaken) {
        this.jLabelNoOfReadingsTaken = jLabelNoOfReadingsTaken;
    }

    public int getNoOfReadingsTaken() {
        return noOfReadingsTaken;
    }

    public void setNoOfReadingsTaken(int noOfReadingsTaken) {
        this.noOfReadingsTaken = noOfReadingsTaken;
    }

    public JLabel getjLabelLastReadingTakenAt() {
        return jLabelLastReadingTakenAt;
    }

    public void setjLabelLastReadingTakenAt(JLabel jLabelLastReadingTakenAt) {
        this.jLabelLastReadingTakenAt = jLabelLastReadingTakenAt;
    }
    
    

}
