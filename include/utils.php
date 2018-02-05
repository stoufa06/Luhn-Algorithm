<?php
function directory_map($source_dir, $directory_depth = 0, $hidden = FALSE)
{
    if ($fp = @opendir($source_dir))
    {
        $filedata	= array();
        $new_depth	= $directory_depth - 1;
        $source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        
        while (FALSE !== ($file = readdir($fp)))
        {
            // Remove '.', '..', and hidden files [optional]
            if ($file === '.' OR $file === '..' OR ($hidden === FALSE && $file[0] === '.'))
            {
                continue;
            }
            
            is_dir($source_dir.$file) && $file .= DIRECTORY_SEPARATOR;
            
            if (($directory_depth < 1 OR $new_depth > 0) && is_dir($source_dir.$file))
            {
                $filedata[$file] = directory_map($source_dir.$file, $new_depth, $hidden);
            }
            else
            {
                $filedata[] = $file;
            }
        }
        
        closedir($fp);
        return $filedata;
    }
    
    return FALSE;
}

function read_file($file)
{
    return @file_get_contents($file);
}

function log_message($message, $level = 'info')
{
    echo strtoupper($level). "\t- " . $message.PHP_EOL;
}

function info($message)
{
    log_message($message, 'info');
}

function success($message)
{
    log_message($message, 'success');
}

function error($message)
{
    log_message($message, 'error');
}

function fail($message)
{
    log_message($message, 'fail');
}

function debug_variable($variable) {
    echo '<pre>'.print_r($variable, true).'</pre>'.PHP_EOL;
}

function function_name($param) {
    ;
}