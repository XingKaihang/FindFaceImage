<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index()
	{
		if(!set_time_limit(0))
		{
			echo "not set ";
			return ;
		}
		$database = M('actress');
		$file = fopen("D:\wamp\www\\facescrub_actresses.txt", "r"); 
		if($file)
			echo "file open";
		else
			echo "file not open";
		if($database)
			echo " database open";
		else
			echo " databasenot open";
		echo "</br>";
		$line = fgets($file);
		for($i=1,$count = 0,$temp_name = "";!feof($file);$i++)
		{
			$line = fgets($file);
			$line_array = explode("	",$line);
			$record['url'] = $line_array[3];
			$record['name'] = $line_array[0];
			if($temp_name != $record['name'])
			{
				$count = 1;
				$temp_name = $record['name'];
			}
			else if ($temp_name == $record['name'])
			{
				$count++;
				if($count <7 || $count >10)
					continue;
			}
			
			
			$type = strtolower( substr($record['url'],strrpos($record['url'],".")));		
			$record['save_name'] = $line_array[0]."_".$i.$type;
			
			
			ob_start(); 
			readfile($record['url']); 
			$img = ob_get_contents(); 
			ob_end_clean(); 
			
			//"../../images/books/"为存储目录，$filename为文件名
			$fp2=fopen("D:\\face_f\\".$record['save_name'], "w"); 
			$result1 = fwrite($fp2,$img); 
			fclose($fp2);
			if($result1)
			{
				$result2 = $database->add($record);
				if($result2)
				{
					echo $i." write success: ".$record['name'];
					echo "</br>";
				}
			}
			else
			{
				echo $i." download fail: ".$record['name'];
				echo "</br>";
			}
		}
		
		
		fclose($file); 
		
		
		
		//male
		
		$database = M('actor');
		$file = fopen("D:\wamp\www\\facescrub_actors.txt", "r"); 
		if($file)
			echo "file open";
		else
			echo "file not open";
		if($database)
			echo " database open";
		else
			echo " databasenot open";
		echo "</br>";
		$line = fgets($file);
		
		for($i=1,$count = 0,$temp_name = "";!feof($file);$i++)
		{
			$line = fgets($file);
			$line_array = explode("	",$line);
			$record['url'] = $line_array[3];
			$record['name'] = $line_array[0];
			if($temp_name != $record['name'])
			{
				$count = 1;
				$temp_name = $record['name'];
			}
			else if ($temp_name == $record['name'])
			{
				$count++;
				if($count <7 || $count >10)
					continue;
			}
			$type = strtolower( substr($record['url'],strrpos($record['url'],".")));		
			$record['save_name'] = $line_array[0]."_".$i.$type;
			
			
			ob_start(); 
			readfile($record['url']); 
			$img = ob_get_contents(); 
			ob_end_clean(); 
			
			//"../../images/books/"为存储目录，$filename为文件名
			$fp2=fopen("D:\\face\\".$record['save_name'], "w"); 
			$result1 = fwrite($fp2,$img); 
			fclose($fp2);
			if($result1)
			{
				$result2 = $database->add($record);
				if($result2)
				{
					echo $i." write success: ".$record['name'];
					echo "</br>";
				}
			}
			else
			{
				echo $i." download fail: ".$record['name'];
				echo "</br>";
			}
		}
		
		
		fclose($file); 
    }
}