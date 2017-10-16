/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mit.edu.deshan.util;

import java.awt.Desktop;
import java.io.BufferedReader;
import java.io.Console;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.math.BigDecimal;
import java.sql.Time;
import java.text.DecimalFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;



public class CommonUtil {

    public static final String DATE_FORMAT = "dd-MM-yyyy";
    public static final String DATE_TIME_FORMAT = "dd-MM-yyyy hh:mm:ss a";

    
    private static final SimpleDateFormat format = new SimpleDateFormat(DATE_FORMAT);
    private static final SimpleDateFormat dateTimeFormat = new SimpleDateFormat(DATE_TIME_FORMAT);


    //this is used in both StudentDAODBImpl and TeacherDAODBImpl - so place it in a common place
    public static java.sql.Date getSQLDateFromUtilDate(java.util.Date date) {
        //check null to prevent Nullpointerexception
        if (!(date == null)) {
            return new java.sql.Date(date.getTime());
        }
        return null;
    }

    public static Date getParsedDateFromString(String dateString) {
        if (!(dateString == null)) {
            dateString = dateString.trim();
            try {
                return format.parse(dateString);
            } catch (ParseException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

    public static String getFormattedDate(Date date) {
        if (!(date == null)) {
            return format.format(date);
        }
        return null;
    }
    
     public static String getFormattedDateTime(Date date) {
        if (!(date == null)) {
            return dateTimeFormat.format(date);
        }
        return null;
    }

    
    public static Time getSQLTimeFromUtilDate(Date date) {
        if (!(date == null)) {
            return new java.sql.Time(date.getTime());
        }
        return null;
    }
    
    


}
