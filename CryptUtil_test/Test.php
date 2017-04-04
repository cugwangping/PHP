<?php
	extension_loaded('openssl');
	class CryptUtil
	{
		function encrypt(string $p12FileName, string $cerFileName2, string $text)
		{
			//$text="......";
			
			//˽Կ������ 
			$privatekeyFile = dirname(__FILE__).'/private_key.pem';		//˽Կ
			$passphrase = '';		//����
			
			//ժҪ��ǩ���㷨
			$digestAlgo = 'MD5';
			$algo = OPENSSL_ALGO_MD5;
			
			//����˽Կ
			$privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile),$passphrase);
			
			//����ժҪ
			$digest = openssl_digest($text, $digestAlgo);

			//ǩ��
			$signature = '';
			openssl_sign($digest, $signature, $privatekey, $algo);
			$signature = base64_encode($signature);
			
			var_dump($signature);
			
			//��Կ
			$publickeyFile = dirname(__FILE__).'/public_key.pem';
			
			//���ع�Կ
			$publickey = openssl_pkey_get_public(file_get_contents($publickeyFile));
			
			//ʹ�ù�Կ���м���
			$encryptedText = '';
			openssl_public_encrypt($text, $encryptedText, $publickey);
			
			var_dump(base64_encode($encryptedText));
		}	
		
		
		function decrypt($fmsg, $gmsg)
		{
			$text = '......';
			
			//base64_encode���ļ�������
			$encryptedText = 'xxxxxx';
			
			//˽Կ������
			$privatekeyFile = '/path/private.key';
			$passphrase = '';
			
			//����˽Կ
			$privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile), $passphrase);
			
			//ʹ��˽Կ���н���
			$sensitiveText = '';
			openssl_private_decrypt(base64_decode($encryptedText), $sensitiveText, $privatekey);
			
			var_dump($sensitiveText);		//��������Textһ��
			//��Կ
			$publickeyFile = '/path/public.key';
			
			//ժҪ��ǩ���㷨
			$digestAlgo = 'MD5';
			$algo = OPENSSL_ALGO_MD5;
			
			//���ع�Կ
			$publickey = openssl_pkey_get_public(file_get_contents($publickeyFile));
			
			//����ժҪ
			$digest = openssl_digest($text, $digestAlgo);
			
			//��ǩ
			$verify = openssl_verify($digest, base64_decode($signature), $publickey, $algo);
			var_dump($verify);		// int(1)��ʾ��ǩ�ɹ�
		}
	}
?>