<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/21/2017
 * Time: 8:27 AM
 */
namespace Modules\Account\Adldap;
use Adldap\Laravel\Facades\Adldap;

class adldapmodel
{
    public function DisableAccount($username){
        $data=Adldap::getProvider('default')->search()->users()->find($username);
        $data->setAttribute('useraccountcontrol',66050);
        if($data->save() == true)
            return true;
        else
            return false;
    }
    public function EnableAccount($username){
        $data=Adldap::getProvider('default')->search()->users()->find($username);
        $data->setAttribute('useraccountcontrol',66048);
        if($data->save() == true)
            return true;
        else
            return false;
    }
    public function CreateNewUser($OU,$username,$password){
        $user = Adldap::make()->user();
        $data=$this->MakeUserID($username);
        $user->setCommonName($data['fullname']);
        $user->setAccountName(strtolower($data['accountname']));

        $user->setFirstName($data['firstname']);
        $user->setLastName($data['lastname']);
        $user->setDisplayName($data['fullname']);
        $user->setUserPrincipalName(strtolower($data['accountname']));
        $user->setCompany('ODS');
        $user->setEmail(strtolower($data['accountname']).'@ods.vn');
        $dn = $user->getDnBuilder();
        $dn->addCn($data['fullname']);
        $dn->addOu($OU);
        $dn->addOu('ODSCenter');
        $user->setDn($dn->get());

        if ($user->save()) {
            $user->setUserAccountControl(66048);
            $user->setPassword($password);
            if($user->save()) {
                if($data['fullname'] == $username){
                    return 0;
                }
                else
                {
                    return 1;
                }
            }
        }

    }
    public function MakeUserID($username){
        $data=explode(" ",$username);
        $Result['accountname']=$data[count($data)-1];
        $Result['lastname']=$data[count($data)-1];
        $Result['firstname']="";
        $Result['fullname']=$username;
        for($i=0;$i<count($data)-1;$i++){
            $Result['accountname'].=substr($data[$i],0,1);
            $Result['firstname'].=$data[$i]." ";
        }
        $FirstExist=Adldap::getProvider('default')->search()->users()->find($Result['fullname']);
        if($FirstExist == null){
            return $Result;
        }else{
            for($i=1;$i>0;$i++)
            {
                $UserData=array();
                $UserData['accountname']=$Result['accountname'].$i;
                $UserData['fullname']=$username." ".$i;
                $SecondExist=Adldap::getProvider('default')->search()->users()->find($UserData['fullname']);
                if($SecondExist==null){
                    $Result['accountname']=$UserData['accountname'];
                    $Result['fullname']=$UserData['fullname'];
                    return $Result;
                    break;
                }
            }
        }

    }
    public function AddUserToGroup($UserName,$ArrGroup){
        $user=Adldap::getProvider('default')->search()->users()->find($UserName);
        $GroupOfUser=$user->getGroupNames();
        $Result=array();
        foreach ($GroupOfUser as $value){
            $group = Adldap::getProvider('default')->search()->groups()->find($value);
            $user->removeGroup($group['dn']);
        }
        if(count($ArrGroup)>0){
            foreach ($ArrGroup as $item)
            {
                $group = Adldap::getProvider('default')->search()->groups()->find($item);
                if($user->addGroup($group))
                {
                    array_push($Result,$item);
                }
            }
        }
        return $Result;
    }
    public function getorganizationalUnit($OU){
        $dn=Adldap::search()->ous()->find($OU)->getDn();
        $data=Adldap::search()->setDn($dn)->where('objectClass', '=', 'organizationalUnit')->get();
        $result=array();
        $i=0;
        foreach ($data as $item){
            $GroupName=$item['ou'][0];
            $result[$i]['id']=$i;
            $result[$i]['DeptName']=$GroupName;
            $result[$i]['parentId']=null;
            $i=$i+1;
        }
        return $result;
    }
    public function getGroupInOU($OU){
        $dn=Adldap::search()->ous()->find($OU)->getDn();
        $data=Adldap::search()->setDn($dn)->where('objectClass', '=', 'group')->get();
        $result=array();
        foreach ($data as $item){
            $GroupName=$item['cn'][0];
            array_push($result,$GroupName);
        }
        return $result;
    }
    public function getMemberInGroup($GroupName){
        $data = Adldap::search()->groups()->find($GroupName);
        $result=array();
        foreach ($data['member'] as $value){
            $CN=explode(',',$value);
            $MemberName=explode('=',$CN[0]);
            array_push($result,$MemberName[1]);
        }
        return $result;
    }
    public function getMemberInOU($OU,$pageindex,$pageSize){
        $dn=Adldap::search()->ous()->find($OU)->getDn();
        $data=Adldap::search()->setDn($dn)->where('objectClass', '=', 'person')->paginate($pageSize,$pageindex);
        $result=array();
        $i=0;
        foreach ($data as $item){
            $GroupName=$item['cn'][0];
            $isdisable=Adldap::getProvider('default')->search()->users()->find($GroupName)->isDisabled();
            $result[$i]['username']=$GroupName;
            if($isdisable == true){
                $result[$i]['disabled']=1;
            }else{
                $result[$i]['disabled']=0;
            }
            $result[$i]['Total']=count($data);
            $i++;
        }
        return $result;
    }
    public function getAllMemberOU($OU){
        $dn=Adldap::search()->ous()->find($OU)->getDn();
        $data=Adldap::search()->setDn($dn)->where('objectClass', '=', 'person')->get();
        $result=array();
        $i=0;
        foreach ($data as $item){
            $GroupName=$item['cn'][0];
            $isdisable=Adldap::getProvider('default')->search()->users()->find($GroupName)->isDisabled();
            $result[$i]['username']=$GroupName;
            if($isdisable == true){
                $result[$i]['disabled']=1;
            }else{
                $result[$i]['disabled']=0;
            }
            $result[$i]['Total']=count($data);
            $i++;
        }
        return $result;
    }
    public function FindGroupNameOfUser($username){

        $data=Adldap::getProvider('default')->search()->users()->find($username)->getGroups();
        $result=array();
        foreach ($data as $value){
            array_push($result,$value['cn'][0]);
        }
        return $result;
    }
    public function GetInfoOfUser($username){
        $data=Adldap::getProvider('default')->search()->users()->find($username);
        $AllGroup=$this->getGroupInOU('ODSCenter');
        $UserGroup=$this->FindGroupNameOfUser($username);
        $ArrGroup=array();
        $i=0;
        foreach ($AllGroup as $value){
            $Search=adldapmodel::customSearch($value,$UserGroup);
            if($Search!="")
            {
                $ArrGroup[$i]['inGroup']=1;
                $ArrGroup[$i]['GroupName']=$value;
            }else{
                $ArrGroup[$i]['inGroup']=0;
                $ArrGroup[$i]['GroupName']=$value;
            }
            $i++;
        }
        $result=array();
        $result['fullname']=$data['cn'][0];
        $result['username']=$data['samaccountname'][0];
        $result['group']=$ArrGroup;
        $result['createday']=$this->ConvertYMDTime($data['whencreated'][0]);
        $result['lastchange']=$this->ConvertYMDTime($data['whenchanged'][0]);
        $result['lastlogin']=$this->ConvertMicrosoftTime($data['lastlogon'][0]);
        return $result;
    }
    public function ConvertYMDTime($time){
        preg_match("/^(\d+).?0?(([+-]\d\d)(\d\d)|Z)$/i", $time, $matches);
        if (!isset($matches[1]) || !isset($matches[2])) {
            throw new \Exception(sprintf('Invalid timestamp encountered: %s', $time));
        }
        $tz = (strtoupper($matches[2]) == 'Z') ? 'Asia/Ho_Chi_Minh' : $matches[3].':'.$matches[4];
        $date = new \DateTime($matches[1], new \DateTimeZone($tz));
        return $date->format('d-m-Y H:i:s');
    }
    public function ConvertMicrosoftTime($time){
        $date= $time / 10000000 - 11644477200;
        return date('d-m-Y H:i:s',$date);
    }
    public function customSearch($keyword, $arrayToSearch){
        foreach($arrayToSearch as $key => $arrayItem){
            if( stristr( $arrayItem, $keyword ) ){
                return $arrayItem;
            }
        }
    }
    public function SearchArray($key,$field,$array){
        $result=array();
        foreach ($array as $k=>$v){
            if(stripos($v[$field], $key) !== false){
                array_push($result,$v);
            }
        }
        return $result;
    }

}