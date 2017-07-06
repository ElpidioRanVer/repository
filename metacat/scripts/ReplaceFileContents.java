

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;


public class ReplaceFileContents {
	static String oldFileName = "";
	String tmpFileName = "tmp_try.xml";
   public static void main(String[] args) {
   	 oldFileName = args[0];
     new ReplaceFileContents().replace();
   }

   public void replace() {
      

      BufferedReader br = null;
      BufferedWriter bw = null;
      try {
         br = new BufferedReader(new FileReader(oldFileName));
         bw = new BufferedWriter(new FileWriter(tmpFileName));
         String line;
         int aux=0;
         while ((line = br.readLine()) != null) {
            if (aux<2)
            	aux++;
            else{
            line=line.replace("+","");
            line=line.replace("(1 fila)","");
            line=line.replace("(1 row)","");
            bw.write(line+"\n");
        	}
         }
      } catch (Exception e) {
         return;
      } finally {
         try {
            if(br != null)
               br.close();
         } catch (IOException e) {
            //
         }
         try {
            if(bw != null)
               bw.close();
         } catch (IOException e) {
            //
         }
      }
      // Once everything is complete, delete old file..
      File oldFile = new File(oldFileName);
      oldFile.delete();

      // And rename tmp file's name to old file name
      File newFile = new File(tmpFileName);
      newFile.renameTo(oldFile);

   }
}