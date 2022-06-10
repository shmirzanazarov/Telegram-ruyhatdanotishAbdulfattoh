<?php
    define('API_KEY','5151823412:AAFopHmZWV9NGj-3b5v8s3E5C-XBpld4ufc');

    $admin = "1020678098";
    $adminuser = "shmirzanazarov";

    function del($nomi){
        array_map('unlink', glob("step/$nomi.*"));
    }
    function put($fayl, $nima){
        file_put_contents("$fayl", "$nima");
    }

    function pstep($cid,$zn){
        file_put_contents("step/$cid.step",$zn);
    }

    function step($cid){
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step",$step);
    }

    function nextTx($cid,$txt){
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt","$step\n$txt");
    }

    function ty($ch){
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    function ACL($callbackQueryId, $text = null, $showAlert = false)
    {
        return bot('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    function bot($method,$datas=[]){
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
        $res = curl_exec($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }else{
            return json_decode($res);
        }
    }

    $update = json_decode(file_get_contents('php://input'));
    $message = $update->message;
    $cid = $message->chat->id;
    $cidtyp = $message->chat->type;
    $miid = $message->message_id;
    $name = $message->chat->first_name;
    $user = $message->from->username;
    $tx = $message->text;
    $callback = $update->callback_query;
    $mmid = $callback->inline_message_id;
    $mes = $callback->message;
    $mid = $mes->message_id;
    $cmtx = $mes->text;
    $mmid = $callback->inline_message_id;
    $idd = $callback->message->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida = $callback->id;
    $cqid = $update->callback_query->id;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->message->chat->type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    mkdir("step");

    $otex = "Bekor qilish";

    $keys = json_encode([
        'resize_keyboard'=>true,
        'keyboard' => [
            [['text' => "Kurslar"],],
            [['text' => "Biz haqimizda"],['text' => "Aloqa"],],
            [['text' => "Manzil"],['text' => "Ro`yhatdan o`tish"],],
        ]
    ]);

    $otmen = json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
            [['text'=>"$otex"],],
        ]
    ]);

    $manzil = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "Awesome", 'text' => "Awesome"],['callback_data' => "So-so", 'text' => "So-so"],],
        ]
    ]);

    $kurs = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Front End"], ['text' => "Back End"],],
            [['text' => "Python (Django)"], ['text' => "Go Lang"],],
            [['text' => "Ortga qaytish"],],
        ]
    ]);

    $tasdiq = json_encode(
        ['inline_keyboard' => [
            [['callback_data' => "ok", 'text' => "Ha"],['callback_data' => "clear", 'text' => "Yo'q"],],
        ]
    ]);

    if(isset($tx)){
        ty($cid);
    }

    if($tx == "/start"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }
    if ($tx == "Biz haqimizda") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Biz haqimizda Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

    if ($tx == "Aloqa") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Biz bilan bog'lanish: \nTel.: +998(90)12345671\nE-mail: infocodeleader@gmail.com\n",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }
    if ($tx == "Manzil") {
        bot('sendLocation', [
            'chat_id' => $cid,
            'latitude' => 41.326387,
            'longitude' => 69.229802,
            'reply_markup' => $keys,
        ]);
    }
   

    if ($tx == "Kurslar") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Aynan qaysi yo'nalishdagi kursimiz haqida ma'lumot kerak ?*",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "Front End") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "Back End") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "Python (Django)") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "Go Lang") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nesciunt molestiae consectetur fugiat iste soluta autem iusto repellendus ipsum, ducimus voluptate qui cupiditate dolor saepe facere, fuga amet voluptas enim.",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "Ortga qaytish") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

    // register uchun
    if($tx == "Ro`yhatdan o`tish"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Ismingiz?\n(Masalan : Sherzod)",
            'parse_mode' => 'markdown',
            'reply_markup' => $otmen,
        ]);
        pstep($cid,"0");
        put("step/$cid.menu","register");
    }

    if($step == "0" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Yoshingiz\n(Masalan : 17)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "Shogird: ". $tx);
        step($cid);
        }
    }

    if($step == "1" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Qaysi yo'nalish bo'yicha tahsil olmoqchisiz?\n(Masalan : FrontEnd, BackEnd...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "Yosh: ".$tx);
        step($cid);
        }
    }

    if($step == "2" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Tanlagan yo'nalishingiz bo'yicha bilim darajangiz qanday?\n(Masalan : umuman yoq, ozmoz bilaman...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
            nextTx($cid, "texnologiya: ".$tx);
            step($cid);
        }
    }

    if($step == "3" and $menu == "register"){
        bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : +998911234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
        nextTx($cid, "Daraja: ".$tx);
        step($cid);
    }

    if($step == "4" and $menu == "register"){
        if($tx == $otex){}else{
            if(mb_stripos($tx,"998")!==false){
            bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=>"Ma'lumotlar muvaffaqiyatli saqlandi, bot faoliyatini baholang?",
                    'parse_mode'=>'markdown',
                    'reply_markup' => $manzil,
                ]);
                nextTx($cid, "Aloqa: ".$tx);
                step($cid);
            }else{
                bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : 998901234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
            }
        }
    }

    if(isset($data) and $stepe == "5" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"<b>sizning anketangiz tayyor bo'ldi, barcha ma'lumotlaringizni tasdiqlaysizmi?</b>
            $baza\n Rating : $data",
            'parse_mode'=>'html',
            'reply_markup'=>$tasdiq,
        ]);
        nextTx($cbid, "Rating: ".$data);
        step($cbid);
    }

    if($data == "ok" and $stepe == "6" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$admin,
            'text'=>"<b>Yangi o'quvchi!</b>
            Username: @$cbuser
            <a href='tg://user?id=$cbid'>profil</a><code>$baza</code>",
            'parse_mode'=>'html',
        ]);
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"Sizning Anketangiz xodimlarimizga muvaffaqiyatli jo'natildi",
            'parse_mode'=>'html',
            'reply_markup'=>$keys,
        ]);
        del($cbid);
    }
    if($tx == $otex or $data == "clear"){
    ACL($ida);
    del($cbid);
    del($cid);
    if(isset($tx)) $url = "$cid";
    if(isset($data)) $url = "$cbid";
        bot('sendMessage', [
        'chat_id'=>$url,
        'text'=>"Anketa bekor qilindi!",
        'reply_markup' => $keys,
        ]);
    }

?>

    