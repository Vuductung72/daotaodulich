<?php

namespace App\Components\Partners;

use Illuminate\Support\Str;

class Tele extends Partner
{
    protected function getBaseUri()
    {
        return $this->getConfigData('domain') . '/';

    }

    public function getUpdate($token)
    {
        return $this->makeRequest('https://api.telegram.org/bot'.$token.'/getUpdates' , 'GET');
    }

    public function send($user,$error,$amount) {
        if($error == 'success') $message = ' Thành công';
        else $message = ' Thất bại';

        $message = '- Khách hàng : '.$user->name.'. ID : '.$user->id
            . "\n- Nạp ".$message." với số tiền " . number_format($amount) .' VNĐ'
            . "\n- Ngày giao dịch " . date(" H:i:s d-m-Y");
        return $this->makeRequest('https://api.telegram.org/bot5927826275:AAFMWLq8KGjRqJcO8RMtPhXeB-K90D0ykH0/sendMessage?chat_id=-942655231&text='.$message.'' , 'GET');
    }

    public function withdraw($user,$error,$amount) {

        $message = '- Khách hàng : '.$user->name.'. ID : '.$user->id
            . "\n- Tạo lệnh rút tiền với số tiền " . number_format($amount) .' VNĐ'
            . "\n- Ngày giao dịch " . date(" H:i:s d-m-Y");
        return $this->makeRequest('https://api.telegram.org/bot6074363202:AAFgX-glaYFFU8PhKS_cJQEpzH5BtFOVG90/sendMessage?chat_id=-856630437&text='.$message.'' , 'GET');
    }
}

