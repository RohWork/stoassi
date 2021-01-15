<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member_Model
 *
 * @author yakim
 */
class Member_Model extends CI_Model{
    
    // 생성자
    function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE); 
    }
    
    public function get_userinfo($user_id) {
        
        $sSql = "SELECT M.* , IF(M.is_admin = 'Y', (SELECT idx FROM biz_member WHERE id = M.id), '') biz_idx, PI.icecream, PI.eng_name, PI.face, PI.partner, PI.face_use_yn, PI.reading_info
                FROM member M
                LEFT JOIN phonics_info PI on M.idx = PI.member_idx
                WHERE id = '$user_id' AND state = '1'";    
                
        $query = $this->db->query($sSql);
        $info = $query->row_array();
        return  $info;
    }
        function selectMemberInfoIdx($idx) {

        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('idx', $idx);

        return $this->db->get()->row();
    }
    
    public function get_memberinfo_idx($user_idx){
        $sSql = "SELECT M.*, PI.* FROM member M 
                LEFT JOIN phonics_info PI on M.idx = PI.member_idx
                WHERE M.idx='".$user_idx."'";
        $query = $this->db->query($sSql);
        return $query->row_array();
    }
    
    public function get_member_study_info_idx($user_idx) {
        $sSql = "SELECT count(1) cnt from study_info WHERE member_idx = '".$user_idx."' AND study_state = '10' "; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    
    //총회원 수
    public function get_member_total_count($params){
        $sWhereSql = "";
        
        if(!empty($params['code'])){
            if($params['depth']=='A'){
                $sWhereSql .= " AND A.code like '".substr($params['code'],0,1)."%'";
            }else if($params['depth']=='B'){
                $sWhereSql .= " AND A.code like '".substr($params['code'],0,2)."%'";
            }else if($params['depth']=='C'){
                $sWhereSql .= " AND A.code = '".$params['code']."'";
            }
        }
        
        if(!empty($params['searchkey'])&&!empty($params['searchkeyword'])){
            if($params['searchkey']=='A.name'||$params['searchkey']=='A.id'){
                $sWhereSql .= " AND ".$params['searchkey']." = '".$params['searchkeyword']."'";
            }else if($params['searchkey']=='A.mobile_phone'){
                $sWhereSql .= " AND ".$params['searchkey']." like '%".$params['searchkeyword']."'";
            }else if($params['searchkey']=='email'){
                $sWhereSql .= " AND ".$params['searchkey']." like '%".$params['searchkeyword']."%'";
            }
        }
        if(!empty($params['searchkey2'])&&!empty($params['searchkeyword2'])){
            if($params['searchkey2']=='B.name'||$params['searchkey2']=='C.name'||$params['searchkey2']=='C.id'){
                $sWhereSql .= " AND ".$params['searchkey2']." = '".$params['searchkeyword2']."'";
            }else if($params['searchkey2']=='C.tel'){
                $sWhereSql .= " AND (C.tel like '%".$params['searchkeyword2']."' OR C.hp like '%".$params['searchkeyword2']."%')";
            }
        }         
        $sSql = "   SELECT "
                . "     count(*) totalcnt"
                . " FROM member A"
                . " LEFT JOIN biz_category B ON A.code=B.code"
                . " LEFT JOIN biz_member C ON B.code=C.code"
                . " WHERE 1 ".$sWhereSql;
        $query = $this->db->query($sSql);
        return $query->row(1)->totalcnt;        
    }
    
    //회원 목록
    public function get_member_list($nStart,$nScale,$params){
        
        $sWhereSql = "";
        
        if(!empty($params['code'])){
            if($params['depth']=='A'){
                $sWhereSql .= " AND A.code like '".substr($params['code'],0,1)."%'";
            }else if($params['depth']=='B'){
                $sWhereSql .= " AND A.code like '".substr($params['code'],0,2)."%'";
            }else if($params['depth']=='C'){
                $sWhereSql .= " AND A.code = '".$params['code']."'";
            }
        }
        
        if(!empty($params['searchkey'])&&!empty($params['searchkeyword'])){
            if($params['searchkey']=='A.name'||$params['searchkey']=='A.id'){
                $sWhereSql .= " AND ".$params['searchkey']." = '".$params['searchkeyword']."'";
            }else if($params['searchkey']=='A.mobile_phone'){
                $sWhereSql .= " AND ".$params['searchkey']." like '%".$params['searchkeyword']."'";
            }else if($params['searchkey']=='email'){
                $sWhereSql .= " AND ".$params['searchkey']." like '%".$params['searchkeyword']."%'";
            }
        }
        if(!empty($params['searchkey2'])&&!empty($params['searchkeyword2'])){
            if($params['searchkey2']=='B.name'||$params['searchkey2']=='C.name'||$params['searchkey2']=='C.id'){
                $sWhereSql .= " AND ".$params['searchkey2']." = '".$params['searchkeyword2']."'";
            }else if($params['searchkey2']=='C.tel'){
                $sWhereSql .= " AND (C.tel like '%".$params['searchkeyword2']."' OR C.hp like '%".$params['searchkeyword2']."%')";
            }
        }        
        $sSql = "   SELECT "
                . "     A.*,B.name AS category_name,C.name AS biz_name,C.id AS biz_id,C.tel,C.hp "
                . " FROM member A "
                . " LEFT JOIN biz_category B ON A.code=B.code"
                . " LEFT JOIN biz_member C ON B.code=C.code"
                . " WHERE 1 ".$sWhereSql
                . " ORDER BY idx DESC "
                . " LIMIT {$nStart},{$nScale}";

        $query = $this->db->query($sSql);
        return $query->result_array();
    }
    public function get_id_chk($id){
        $sSql = "SELECT count(*) cnt FROM member WHERE id='".$id."'";
        $query = $this->db->query($sSql);
        return $query->row(1)->cnt;        
    }
    public function set_update_lastlogin($user_id){
        $sSql = "UPDATE member SET last_login_date = now() WHERE id ='".$user_id."'";
        $this->db->query($sSql);        
    }
    public function set_speaking_update_lastlogin($user_id){
        $sSql = "UPDATE lt_speaking_member SET last_login_date = now() WHERE id = '".$user_id."' "; 
        $this->db->query($sSql); 
    }
    public function get_sido_list(){
        $sSql = "SELECT sido FROM zipcode GROUP BY sido ORDER BY sido ASC";
        $query = $this->db->query($sSql);
        return $query->result_array();        
    }
    public function get_gugun_list($sido){
        $sSql = "SELECT gugun FROM zipcode WHERE sido='".urldecode($sido)."' GROUP BY gugun ORDER BY gugun ASC";
        $query = $this->db->query($sSql);
        return  $query->result_array();        
    }    

    public function get_post_address($dong){
        $sSql = "SELECT zipcode,sido,gugun,dong,bunji FROM zipcode WHERE dong like '%".urldecode($dong)."%' ORDER BY seq ASC";
        $query = $this->db->query($sSql);
        return  $query->result_array();        
    }
    public function set_join($params){

        $this->db->set('join_date', 'NOW()', FALSE);
        $this->db->set('last_login_date', 'NOW()', FALSE);
        $rowid = $this->db->insert("member", $params);     
        
        return $rowid;
        
    }
    public function set_modify($idx,$params){
        $this->db->where("idx", $idx);
        $result =  $this->db->update("phonics_info", $params); 
        return $result;        
    }
    public function set_login_member_log($user_id,$agent,$referer, $service='pc'){
        
        $ip = $_SERVER['REMOTE_ADDR']; 
        if(array_key_exists('HTTP_X_FORWARD_FOR', $_SERVER)) {
            $ip = $_SERVER["HTTP_X_FORWARD_FOR"]; 
        } 
        
        $data = array(
            "service"   => $service, 
            "mode"      => "login", 
            "id"        => $user_id, 
            "agent"     => $agent, 
            "referer"   => $referer, 
            "ip"        => $ip, 
            "regi_date"     => date("Y-m-d H:i:s"), 
            "msg"       => "ok", 
            "state"     => "1"
        ); 
        
        $this->db->insert("phonics_access_log", $data); 
        $rowid = $this->db->insert_id(); 
        
        return $rowid; 
    }
   
    
    public function get_member_info($user_id){
        $sSql = "SELECT *, idx user_no FROM member WHERE id='".$user_id."'";
        $query = $this->db->query($sSql);
        return $query->row_array();               
    }
    
    // avatar_yn: 'n'아바타설정필요, first_reward_yn: 'n'첫로그인보상필요
    public function get_user_first_login_check($user_idx)
    {
        $sSql = "SELECT distinct M.idx, 
                    case S.study_state when '10' then '1' 
                               when '12' then '4' 
                               when '19' then '6'
                               else S.study_state end study_state,
                    if(isnull(A.avatar_name), 'n', 'y') as avatar_yn, 
                    lower(if(isnull(M.first_reward), 'n', M.first_reward)) as first_reward_yn
                 FROM member M
                 LEFT JOIN member_avatar A
                 ON M.idx = A.member_idx
                 LEFT JOIN study_info S
                 ON A.member_idx = S.member_idx
                 WHERE M.idx = '".$user_idx."' AND S.study_state = '10' 
                 ORDER BY S.study_state "; 
        $query = $this->db->query($sSql); 
        return $query->row(); 
    }
    
    //  유/무료 회원 구분
    public function get_user_pay_goods($user_idx) 
    {
        $sSql = "SELECT count(1) cnt
                 FROM member M
                 LEFT JOIN study_info S
                 ON M.idx = S.member_idx 
                    left join refund_info r
                    on r.study_idx = S.idx and r.is_approval = 'Y' and r.refund_type = 'H'
                    left join refund_pause_status rp         
                    on rp.refund_info_idx = r.idx
                    left join goods_category gc
                    on S.goods_category_idx = gc.idx
                 WHERE  M.idx = '".$user_idx."' and (
                     S.study_state = '10' or (S.study_state = '19' and (curdate() < rp.holding_sdate or curdate() > rp.holding_edate))
                )  and gc.name_en in ('B') "; 
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        
        if($result->cnt > 0) {
            return true; 
        } else {
            return false; 
        }
    }
    
    // ranking 정보 추후 수정 예정 - ranking(weekly ranking 적용), 학습 상태(정상) 조회 
    public function get_user_studyinfo($user_id) {
        $sSql = "select distinct s.idx study_info_idx, 
            s.goods_category_idx, 
            case s.study_state when '10' then '1' 
                               when '12' then '4'
                               when '19' then if (curdate() < rp.holding_sdate or curdate() > rp.holding_edate, '1', '6')
                               else s.study_state end study_state, 
            IFNULL(s.learn_date, s.start_date) start_date, s.end_date, s.study_stime, s.study_etime, ifnull(mss.time_num, s.attendance_time) study_time, s.total_score, 
            if(datediff(s.end_date, curdate()) <= 20, 'Y', 'N') notice_expire,
            datediff(s.end_date, curdate()) expire_days,
            gc.name, gc.name_en,
            if((select count(idx) cnt FROM study_info WHERE member_idx = m.idx AND study_state = '10' and goods_category_idx = 3) > 0, 'Y', 'N') bigcatLiveInfo
            from member m
            left join study_info s
            on m.idx = s.member_idx
            left join member_study_schedule mss
            on s.idx = mss.study_info_idx AND mss.day_num = dayofweek(curdate())
            left join goods_category gc
            on s.goods_category_idx = gc.idx
            left join refund_info r
            on r.study_idx = s.idx and r.is_approval = 'Y' and r.refund_type = 'H'
            left join refund_pause_status rp         
            on rp.refund_info_idx = r.idx 

            where m.id = '".$user_id."' 
                and ( s.study_state = '10' 
                or (s.study_state = '19' and (curdate() < rp.holding_sdate or curdate() > rp.holding_edate) )
                ) AND gc.name_en in ('B')"; 
             // 10: 승인, 12: 휴회, 19: 홀딩 - 12개월 상품 1회 
        
        $query = $this->db->query($sSql);
        return $query->result(); 
    }
    
    public function set_session($params, $key) {
      
        $sSql = "SELECT * FROM ci_sessions WHERE id = '".$key."' and platform = 'APP'"; 
        $query = $this->db->query($sSql); 
        $userdata = $query->row(); 
        
        if($userdata) {
            $sSql = "UPDATE ci_sessions SET data = '' WHERE id='".$key."' and platform = 'APP'"; 
            $this->db->query($sSql); 
        }
        
        $userdata2 = array(
            "sa_id"         => $params["id"],
            "member_id"     => $params["id"],
            "sa_nm"         => $params["name"],
            "sa_no"         => $params["idx"],
            "biz_sa_no"     => $params["biz_idx"],
            "is_admin"      => $params["is_admin"],
            "session_id"    => $key
        );
        
        $this->session->set_userdata($userdata2);  
        
        session_commit(); // Session DB write 후에 custom column 추가할 수 있음
    }
    
    // ci_sessions table custom column user_id
    public function set_session_userid($user_id, $key) {
        
        $userdata = array(
            "user_id"   => $user_id
        ); 

        $this->db->where("id", $key); 
        $this->db->where("platform", 'APP'); 
        $this->db->update("ci_sessions", $userdata); 

    }
    
    public function destroy_session($key) {
        
        $sSql = "DELETE FROM ci_sessions WHERE id='".$key."' and platform = 'APP'"; 
        $this->db->query($sSql); 
    }
    
    public function destroy_session2($user_id) {
        
        $sSql = "DELETE FROM ci_sessions WHERE user_id = '".$user_id."' and platform = 'APP'"; 
        $this->db->query($sSql); 
    }
    
    public function check_session($user_id, $ip) {
        
        $sSql = "SELECT id, ip_address, FROM_UNIXTIME(`timestamp`,'%Y-%m-%d %H:%i:%s') date, timestamp, data, user_id FROM ci_sessions WHERE user_id='".$user_id."' AND ip_address = '".$ip."' and use_yn = 'Y' and platform = 'APP'"; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    public function check_session2($key) {
        
        $sSql = "SELECT id, ip_address, timestamp, data, user_id, use_yn, platform FROM ci_sessions WHERE id = '".$key."'"; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    public function check_session_live($key, $ip) {
        
        $sSql = "SELECT id, ip_address, timestamp, data, user_id, use_yn FROM ci_sessions WHERE id = '".$key."' /* AND ip_address = '".$ip."' */  and platform = 'APP'"; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    
    public function destroy_other_device_session($user_id, $ip) {
        
    //    $sSql = "DELETE FROM ci_sessions WHERE user_id = '".$user_id."' AND ip_address != '".$ip."' "; 
        
        $sSql = "UPDATE ci_sessions set use_yn = 'N' WHERE user_id = '".$user_id."' and platform = 'APP'"; // AND ip_address != '".$ip."' "; 
        $this->db->query($sSql); 
    }
    
    public function get_confirm_session($session_id, $user_id, $ip) {
        
        $sSql = "SELECT id, ip_address, FROM_UNIXTIME(`timestamp`,'%Y-%m-%d %H:%i:%s') date, timestamp, data, user_id FROM ci_sessions WHERE id = '".$session_id."' AND user_id ='".$user_id."' AND ip_address='".$ip."' and platform = 'APP'"; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    
    
    /* 
     * 2020.09.07 아바타 관련 by 노진국
     */
    
    //아바타리스트
    public function get_avatar_list($category_idx, $member_idx) {
        $sSql = "SELECT pa.idx,pa.`name_en`, pa.`name_kr`, pa.`regi_date`, pa.`state`, pac.`idx` AS category_idx,
		 IF(pc.idx IS NULL, 'N' ,'Y') AS buyYN, pa.icecream, pa.src
                 FROM phonics_avatar pa
                 LEFT JOIN phonics_avatar_category pac
                 ON pa.category_idx = pac.idx 
                 LEFT JOIN phonics_closet pc 
                 on pa.idx = pc.avatar_idx
                 and pc.member_idx = '".$member_idx."'
                 WHERE pac.idx= '".$category_idx."' 
                 ORDER BY pa.idx"; 
        $query = $this->db->query($sSql); 
        return $query->result_array(); 
    }
    
    
    public function get_avatar_info($avatar_idx) {
        $sSql = "SELECT pa.icecream, pa.name_kr
                 FROM phonics_avatar pa
                 WHERE pa.idx= '".$avatar_idx."' "; 
        $query = $this->db->query($sSql); 
        return $query->row_array(); 
    }
    
    public function get_avatar_category_list() {
        $sSql = " SELECT idx, name as name_kr, name_en  
                  FROM phonics_avatar_category  
                "; 
        $query = $this->db->query($sSql); 
        return $query->result_array(); 
    }
    
    // 아바타 구매
    public function set_avatar_buy($params) {
        
        $this->db->set('regi_date', 'NOW()', FALSE);
 
        $rowid = $this->db->insert("phonics_closet", $params);     
          
     
        return $rowid;
    }
    
    // 아바타 장착
    public function set_phonics_avatar($closet_idx, $member_idx) 
    {
        $data = array(
            "put_yn"    => "N",
            "modi_date" => date('Y-m-d H:i:s')
        ); 
        $this->db->where("member_idx", $member_idx); 
        $result = $this->db->update("phonics_closet", $data); 
        
        
        $data = array(
            "put_yn"    => "Y",
            "modi_date" => date('Y-m-d H:i:s')
        ); 
       
        $this->db->where("idx", $closet_idx); 
        $result = $this->db->update("phonics_closet", $data); 

        return $result; 
    }
    
    // 아바타 세팅로그
    public function set_phonics_avatar_log($arrays)
    {
        $data = array(
            "avatar_idx"            => $arrays["avatar_idx"],
            "closet_idx"            => $arrays["closet_idx"],
            "state"              => $arrays["state"],
            
        ); 
        $this->db->set('reg_date', 'NOW()', FALSE);
       
        $result = $this->db->insert("phonics_avatar_log", $data);
        
        return $result;
    }
    
    //옷장리스트
    public function get_phonics_closet($member_idx, $category_idx)
    {
        
        $sSql = "SELECT pa.name_en, pa.name_kr, pa.name_en, pc.regi_date, pc.put_yn, pa.category_idx, pa.src, pc.avatar_idx, pc.idx as closet_idx
                 FROM phonics_closet pc
                 LEFT JOIN phonics_avatar pa
                 ON pc.avatar_idx = pa.idx 
                 WHERE pc.member_idx= '".$member_idx."'" ;
        if($category_idx != ""){
           $sSql .= "and pa.category_idx = '".$category_idx."'";
        }

        $query = $this->db->query($sSql); 
        return $query->result_array(); 
    }
    
    
    
    
    public function set_exp($member_idx, $exp)
    {
        $sSql = "UPDATE member set exp = exp + ".$exp." WHERE idx = '".$member_idx."' "; 
        $this->db->query($sSql); 
        $result = $this->db->affected_rows();
        
        if($result) {return true;} 
        else {return false;} 
    }
    

    
    public function set_icecream($member_idx, $icecream, $flag) 
    {
        
        $diaSql = ""; 
        
        if($flag == 'S') {
            $diaSql = " icecream = icecream + ".$icecream; 
        } else if($flag == 'U') {
            $diaSql = " icecream = icecream - ".$icecream; 
        }
        
        if($diaSql != "") {
            $sSql = "UPDATE phonics_info set ".$diaSql." WHERE member_idx = '".$member_idx."' "; 
            
            $this->db->query($sSql); 
            $result = $this->db->affected_rows();
            
            if($result) {return true;} 
            else {return false;} 
        }
        
        return false; 
    }
    
    
    public function set_exp_log($arrays)
    {
        $data = array(
            "member_idx"    => $arrays["member_idx"],
            "exp"           => $arrays["exp"], 
            "remark"        => $arrays["remark"],
            "study_type"    => $arrays["study_type"],
            "reg_date"      => $arrays["reg_date"]
        ); 
        
        $this->db->insert("member_exp_log", $data); 
        $idx = $this->db->insert_id(); 
        
        return $idx; 
    }
    
    
    public function set_icecream_log($arrays)
    {
        $data = array(
            "member_idx"    => $arrays["member_idx"],
            "icecream"       => $arrays["icecream"],
            "flag"          => $arrays["flag"],
            "remark"        => $arrays["remark"],
            "reg_date"      => $arrays["reg_date"]
        ); 
        
        $this->db->insert("icecream_log", $data); 
        $idx = $this->db->insert_id();
        
        return $idx; 
    }
    
    
    // 아이스크림 정보 조회
    public function get_icecream($member_idx)
    {
    //    $sSql = "select coin coin_cnt, diamond diamond_cnt, 0 diamond_piece from member where idx = '".$member_idx."' "; 
        // 학습 승인,홀딩 상태 회원만 정보 조회되고 휴회 회원은 0 
        $sSql = "SELECT if(study_state = 'Y', icecream_cnt, 0) icecream_cnt
                FROM (
                    SELECT pi.icecream icecream_cnt
                    , if((select count(idx) from study_info where member_idx = m.idx and study_state in ('10', '19')) > 0, 'Y', 'N') study_state
                    FROM member m 
                    LEFT JOIN phonics_info pi
                    ON m.idx = pi.member_idx
                    WHERE m.idx = '".$member_idx."'
                ) a    ";
        
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        
        return $result; 
    }
    

    
    // 회원의 센터장 정보 조회
    public function get_member_org_biz_member_info($member_idx) 
    {
        $sSql = "SELECT BM.idx, BM.name, BM.id, BM.biz_level, BAC.idx biz_avatar_idx, BAC.avatar_name biz_avatar_name
                 FROM member M 
                 LEFT JOIN biz_member BM
                 ON M.code = BM.code 
                 LEFT JOIN member BM2
                 on BM.id = BM2.id 
                 LEFT JOIN member_avatar BMA
                 ON BM2.idx = BMA.member_idx AND BMA.main_yn = 'Y' 
                 LEFT JOIN animal_avatar_character BAC
                 ON BMA.character_idx = BAC.idx
                 WHERE M.idx = '".$member_idx."' AND BM.state = '1' AND BM.captainyn = 'Y' "; 
        $query = $this->db->query($sSql); 
        return $query->row(); 
    }
    
        // 금일 로그인 기록 있는지 확인(출석보상 1일 1회)
    public function get_member_today_login_history($member_id)
    {
        $sSql = "SELECT count(1) cnt 
                 FROM phonics_access_log
                 WHERE id = '".$member_id."' AND mode = 'login' AND service = 'app' AND date_format(regi_date, '%Y-%m-%d') = curdate() "; 
        $query = $this->db->query($sSql); 
        $login_cnt = $query->row()->cnt; 
        
        if($login_cnt > 1) {return true;} // today 로그인 있음 
        else {return false; }
    }
    
    // 금일 콤보 출석 대상인지 확인
    public function get_member_today_combo_attendance($member_id)
    {
   //     $today = date("Y-m-d");
        
        $this_month = date("Y-m");
        $this_day = date("j"); 
        
        $sSql = "SELECT k 
                 FROM (
                    SELECT wday1 wday, IF(wday1 = wday2+1, @k := @k+1, @k := 1) k
                    FROM (
                        SELECT L.wday wday1, M.wday wday2
                        FROM (
                            SELECT @rownum := @rownum + 1 AS rownum, A.*
                            FROM (
                                SELECT distinct date_format(regi_date, '%Y-%m-%d') regi_date,
                                    cast(date_format(regi_date, '%d') as signed) wday
                                FROM phonics_access_log L
                                WHERE L.id = '".$member_id."' AND L.mode = 'login' AND L.service = 'app'
                                    AND date_format(L.regi_date, '%Y-%m') = '".$this_month."' 
                                ORDER BY wday
                            ) A, (SELECT @rownum := 0) R
                        ) L
                        LEFT JOIN (
                            SELECT @rownum2 := @rownum2 + 1 AS rownum, A.*
                            FROM (
                                SELECT distinct date_format(regi_date, '%Y-%m-%d') regi_date, 
                                    cast(date_format(regi_date, '%d') as signed) wday
                                FROM phonics_access_log L
                                WHERE L.id = '".$member_id."' AND L.mode = 'login' AND L.service = 'app' 
                                    AND date_format(L.regi_date, '%Y-%m') = '".$this_month."' 
                                ORDER BY wday
                            ) A, (SELECT @rownum2 := 1) R
                        ) M
                        ON L.rownum = M.rownum
                    ) B, (SELECT @k := 1) C
                 ) X 
                 WHERE X.wday = ".$this_day." " ; 
        
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        
        if(isset($result)) {
            return $result->k;
        } else {
            return 0; 
        }

    }
    
    // 주말 (금, 토, 일 로그인 출석 대상 확인
    public function get_member_weekends_attendance($member_id, $daynum) {
        
        $sSql = "SELECT count(rowid) cnt 
                 FROM phonics_access_log 
                 WHERE id = '".$member_id."' AND mode = 'login' AND service = 'app' 
                    AND date_format(wdate, '%Y-%m-%d') = date_sub(curdate(), interval ".$daynum." day) ";
        $query = $this->db->query($sSql);
        $result = $query->row(); 
        
        return $result->cnt; 
    }
   
    
    public function is_time($time)
    {
         $str = "/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/";
         if(preg_match($str, $time)) {
             return true;
         } else {
             return false; 
         }
    }
    
    public function get_member_study_in_time_history($study_info_idx)
    {
        $sSql = "SELECT count(1) cnt
                 FROM study_connect_log 
                 WHERE study_info_idx = '".$study_info_idx."' AND date_format(connect_time, '%Y-%m-%d') = curdate() and time_state = 'Y' ";
        
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        
        if($result->cnt > 0) {
            return false;   // 이력 있음  
        } else {
            return true; 
        }
    }
    public function get_member_study_info($study_info_idx){
        
        $sSql = "SELECT SI.*
         FROM study_info SI
         LEFT JOIN member m
         ON SI.member_idx = m.idx
         LEFT JOIN phonics_info PI
         ON PI.member_idx = m.idx
         WHERE SI.idx = '".$study_info_idx."'"; 

        $query = $this->db->query($sSql); 
        return $query->row(); 
        
    }
    
    public function set_study_connect_log($arrays)
    {
        $data = array(
            "study_info_idx"    => $arrays["study_info_idx"],
            "connect_time"      => $arrays["connect_time"], 
            "time_state"        => $arrays["time_state"]
        ); 
        
        $this->db->insert("study_connect_log", $data); 
        $idx = $this->db->insert_id();
        
        return $idx; 
    }
    
    public function set_study_in_time_connect_log($idx, $time_range)
    {
        $sSql = "UPDATE study_connect_log SET time_state = 'Y', time_range = '".$time_range."' WHERE idx = '".$idx."' "; 
        $this->db->query($sSql); 
        $result = $this->db->affected_rows();
        
        if($result) {
            return true;
        } else {
            return false; 
        }
    }
    
    // New Avatar 
    public function get_user_character_avatar($member_idx, $put_yn) {
        
        $sSql = "SELECT pc.idx, pc.avatar_idx, pa.name_en, pa.name_kr, pa.src, pc.regi_date
                 FROM phonics_closet pc
                 LEFT JOIN phonics_avatar pa
                 ON pc.avatar_idx = pa.idx 
                 WHERE pc.member_idx = '".$member_idx."'"; 
        if($put_yn != ""){
            $sSql .= "and pc.put_yn = '".$put_yn."'";
        }

        $query = $this->db->query($sSql); 
        return $query->row(); 
    }
    
    public function get_user_animal_avatar_list($member_idx) {
        
        $sSql = "SELECT MA.idx, MA.character_idx, MA.avatar_name, AC.avatar_name character_name, AC.sub_name, AC.animal, AC.url, AC.s_url, MA.main_yn,
                 FROM member_avatar MA
                 LEFT JOIN animal_avatar_character AC
                 ON MA.character_idx = AC.idx 
                 WHERE MA.member_idx = '".$member_idx."' "; 

        $query = $this->db->query($sSql); 
        return $query->result(); 
    }
    

    // 아바타 캐릭터 목록 조회 
    public function get_avatar_animal_char_list() {
        $sSql = "SELECT idx, avatar_name, sub_name, animal, url, s_url
                 FROM animal_avatar_character 
                 WHERE state = 'Y' order by sort"; 
        $query = $this->db->query($sSql); 
        return $query->result(); 
    }
    
    // 아바타 캐릭터 설정 
    public function set_user_animal_avatar($arrays) 
    {      
        $data = array(
            "member_idx"        => $arrays["member_idx"],
            "character_idx"     => $arrays["character_idx"],
            "avatar_name"       => $arrays["avatar_name"], 
            "main_yn"           => $arrays["main_yn"], 
            "reg_date"          => $arrays["reg_date"]
        ); 
            
        $this->db->insert("member_avatar", $data); 
        $idx = $this->db->insert_id(); 
        
        return $idx; 
    }
    

    
    // main 캐릭터 조회
    public function get_user_main_avatar_idx($idx)
    {
        $sSql = "SELECT idx FROM member_avatar WHERE member_idx = (
                    SELECT member_idx FROM member_avatar 
                    WHERE idx = '".$idx."' ) AND main_yn = 'Y' "; 
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        return $result; 
    }
    
    public function set_user_avatar_state($arrays)
    {
        $data = array(
            "main_yn"   => $arrays["main_yn"],
            "upt_date"  => $arrays["upt_date"]
        );
        
        $idx = $arrays["idx"]; 
        $this->db->where("idx", $idx); 
        
        if($this->db->update("member_avatar", $data)) {
                return true; 
        } else {
            return false; 
        }
    }

    
    
    public function set_ci_session_disconnect_log($arrays)
    {
        $data = array(
            "session_id"    => $arrays["session_id"],
            "ip_address"    => $arrays["ip_address"],
            "return_code"   => $arrays["return_code"],
            "return_status" => $arrays["return_status"],
            "return_message"=> $arrays["return_message"],
            "wdate"         => $arrays["wdate"]
        ); 
        
        $this->db->insert("ci_session_log", $data); 
    }
    
    public function set_terms_agree($user_id) {
        
        $this->db->set('terms', 'Y');
        $this->db->set('edit_date', date('Y-m-d H:i:s'));
        $this->db->set('terms_agree_date', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);
        $this->db->update('member');
        
        return $this->db->affected_rows();        
        
    }
    
    public function get_user_last_payment($member_idx, $goods_category_idx) {
        
        $this->db->select('p.*, g.name as goods_name, g.goods_category_idx');
        $this->db->from('payment_approval as p');
        $this->db->join('goods as g', 'p.goods_idx = g.idx' ,'left');
        $this->db->where('p.member_idx', $member_idx);
        $this->db->where('p.result_code', ALLAT_SRESULT_CODE);
        $this->db->where('g.goods_category_idx', $goods_category_idx);
        $this->db->order_by('p.idx', 'desc');
        $this->db->limit(1);
        
        return $this->db->get()->row();
        
    }
    
    public function get_live_member_info($live_id) {
        
        $this->db->select('m.*, l.live_id');
        $this->db->from('member_live as l');
        $this->db->join('member as m', 'm.idx = l.member_idx');
        $this->db->where('l.live_id', $live_id);
        
        return $this->db->get()->row();
    }
    
    public function get_last_study_live_book($member_idx) {
        
        $sSql = "SELECT B.idx, B.writer, B.name_en, B.name_kr, B.study_level, B.stage, B.sort_num, B.books_type
                    FROM study_info I		
                    JOIN study_book_test_score S ON S.study_info_idx=I.idx             
                    JOIN study_book_test T ON S.book_test_idx=T.idx
                    JOIN study_books B ON T.study_books_idx=B.idx			
                    WHERE I.member_idx='".$member_idx."' AND B.state = 'Y' AND B.live_book_yn = 'Y'             
                    GROUP BY T.study_books_idx
                    ORDER BY CAST(B.study_level AS SIGNED) desc, CAST(B.stage AS SIGNED) desc, CAST(B.sort_num AS SIGNED) desc"; 
        
        $query = $this->db->query($sSql); 
        $result = $query->row(); 
        return $result; 
        
    }
    
    public function set_phonics_info_insert($params){
        $result = $this->db->insert("phonics_info", $params); 
        return $result; 
    }
    
    public function set_phonics_info_update($member_idx,$params){
        
        $this->db->where('member_idx', $member_idx);
        $this->db->update("phonics_info", $params); 
        
        return $this->db->affected_rows();   
    }
    
        
    function findMemberId($name, $phone) {

        $this->db->select('id');
        $this->db->from('member');
        $this->db->where('name', $name);
        $this->db->where('mobile_phone', $phone);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return false;
        }
    }
	
    function findMemberInfo($id, $phone) {

        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id', $id);
        $this->db->where('mobile_phone', $phone);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
	
    function updatePassword($id, $temp_pw) {
        $this->db->set('pw', hash("sha256", $temp_pw, false));
        $this->db->set('edit_date', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        $this->db->update('member');

        return $this->db->affected_rows();
    }
    

    function selectLoginInfo($id, $password) {

        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id', $id);
        $this->db->where('pw', hash("sha256", $password, false));

        return $this->db->get()->row();
    }
    
    function selectMyBigcatBookLevel($member_idx, $bigcat_goods_category_idx) {

        $this->db->select('b.study_level');
        $this->db->from('study_info as s');
        $this->db->join('study_books_library as l', "s.idx = l.study_info_idx AND l.state = 'O'");
        $this->db->join('study_books as b', 'b.idx = l.study_books_idx');
        $this->db->where('s.member_idx', $member_idx);
        $this->db->where('s.goods_category_idx', $bigcat_goods_category_idx);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->study_level;
        } else {
            return false;
        }
    }
    
    function insertMember($vo) {

        $data = array(
            'code' => empty($vo->code) ? null : $vo->code,
            'id' => $vo->id,
            'pw' =>  hash("sha256", $vo->pw, false),
            'name' => $vo->name,
            'mobile_phone' => $vo->phone,
            'parents_phone' => $vo->p_phone,
            'parents_phone_recv' => $vo->recv,
            'sex_division'  => $vo->sex_division,
            'birthday'  => $vo->birthday,
            'registration_type1' => 'D', //가입경로(대분류-A-본사지원/B-본사지원(SKP)/C-직모/D-WEB/E-MOBILE
            'join_date' => date("Y-m-d H:i:s"),
            'terms' => 'Y',
            'terms_agree_date' => date("Y-m-d H:i:s")
        );

        $this->db->insert('member', $data);

        return $this->db->affected_rows();
    }
    
    function change_member_code($vo){
        
        $data = array(
                        "code" => $vo->code
                       );
        
        $this->db->where('idx', $vo->member_idx);

        $this->db->update('member', $data);
    }
	
    function get_study_info($member_idx, $category_idx){
        
        $this->db->select('start_date, end_date, study_state');
        $this->db->select('datediff(end_date, curdate()) as remain_date');
        $this->db->select('datediff(end_date, start_date) as total_date');
        $this->db->from('study_info');
        $this->db->where('member_idx', $member_idx);
        $this->db->where('goods_category_idx', $category_idx);

        return $this->db->get()->row();
        
    }
}
