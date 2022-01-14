import pymysql

# dbConnect
conn = pymysql.connect(host="localhost", user="root", password="passowrd", db="r_studyroom")
curs = conn.cursor()



# 메인화면

def index() :
    print("|-------스터디룸 예약하기-------|")
    print("|                               |")
    print("|    로그인 후 이용가능합니다.  |")
    print("|                               |")
    print("|____ 1.로그인   2.회원가입 ____|")
    main_sel = int(input())
    print()
    if(main_sel==1) :
        login()
        
    elif(main_sel==2) :
        mem_join()
        
    else :
        print("잘못선택하셨습니다. 다시 선택해주세요.","\n")
        index()
        


# 로그인

def login() :
    global mname
    global mid
    
    mid = input("아이디 입력 : ")
    mpw = input("비밀번호 입력 : ")
    
    id_sql = "select * from member where mid = %s"

    curs.execute(id_sql,mid)
    rows = curs.fetchall()

    if(not curs.rowcount) :
        print("등록되지 않은 아이디입니다. 다시 시도해주세요.","\n")
        login()

    elif (rows[0][0] == 'admin') :
        if(mpw == rows[0][1]):
            mname = rows[0][2]
            mid = rows[0][0]
            admin_main()
        else:
            print("일치하지 않는 비밀번호 입니다. 다시 시도해주세요.","\n")
            login()
  
    else :
        if(mpw == rows[0][1]):
            mname = rows[0][2]
            mid = rows[0][0]
            mem_main()
        else:
            print("일치하지 않는 비밀번호 입니다. 다시 시도해주세요.","\n")
            login()
            
        
        
        
# 회원가입

def mem_join() :
    print("*****    회원가입    *****", "\n")
    
    while True :
        jid = input("아이디 입력 : ")
        jid_sql = "select * from member where mid = %s"
        curs.execute(jid_sql,jid)
        rows = curs.fetchall()

        if (not curs.rowcount) :
            print("사용가능한 아이디입니다.","\n")
            break
        else :
            print("이미 사용중인 아이디입니다. 다른 아이디를 입력해주세요.","\n")
            

    while True :
        jpw = input("비밀번호 입력 : ")
        jpw_check = input("비밀번호 확인 : ")

        if (jpw != jpw_check) :
            print("비밀번호가 일치하지 않습니다. 다시 입력해주세요","\n")
        else :
            break

    jname = input("이름 : ")

    jtel = input("전화번호 : ")

    print("\n", "--------------------")
    print("입력한 정보")
    print("아이디 : ", jid)
    print("이  름 : ", jname)
    print("번  호 : ", jtel)
    print("--------------------", "\n")
    
    while True :
        print("\n", "위의 정보로 가입하시겠습니까?", "\n")
        print("1. 가입   2. 취소","\n")
        j_insert = int(input(""))

        if (j_insert == 1) :
            j_sql = "insert into member(mid, mpw, mname, mtel) values(%s, %s, %s, %s)"
            j_val = (jid, jpw, jname, jtel)
            curs.execute(j_sql, j_val)
            conn.commit()
            print("회원가입이 완료되었습니다. 로그인 후 이용해주세요.","\n")
            index()
            
        elif(j_insert == 2) :
            print("회원가입이 취소되었습니다. 메인화면으로 돌아갑니다.","\n")
            index()

        else :
            print("잘못선택하셨습니다. 다시 선택해주세요")
    



# 로그인 성공
        
# 일반회원 메인

def mem_main():
    print()
    print("|-----------스터디룸 예약하기-----------|")
    print("|                                       |")
    print("    ", mid,"(", mname, ")님으로 로그인중입니다.")
    print("|                                       |")
    print("|       1.예약하기   2.예약확인         |")
    print("|                                       |")
    print("|    3.비밀번호 변경   4. 로그아웃      |")
    print("|                                       |")
    print("|_____________ 5. 회원탈퇴 _____________|")

    mmain_sel = int(input())
    
    if(mmain_sel == 1) :
        mem_reservation()

    elif(mmain_sel == 2) :
        mem_reservation_check()

    elif(mmain_sel == 3) :
        mem_update_pw()

    elif(mmain_sel == 4) :
        logout()

    elif(mmain_sel == 5) :
        mem_delete()

    else:
        print("잘못선택하셨습니다. 다시 선택해주세요.","\n")
        mem_main()



# 예약하기

def mem_reservation() :
    
    print("Step 1. 스터디룸 선택","\n")
    print("a","b","c","d","e","f","g","h","i","j",sep="\n")
    
    sname = input("")
    sname = sname.lower()
    if (ord(sname)>106 and ord(sname)<97) :
        while True :
            print("잘못입력하셨습니다. 다시 입력해주세요.")
            sname = int(input(""))
            sname = lower(sname)
            if (not (ord(sname)>106 and ord(sname)<97)) :
                break
            
    print("Step 2. 날짜 선택 (yyyy-mm-dd 형태로 입력)","\n")
    rdate = input("")

    print("Step 3. 시간 선택","\n")
    print("1. 10시","2. 12시","3. 14시","4. 16시", "5. 18시", "6. 20시", sep="\n")
    rtime = int(input(""))

    while True :
        if(rtime == 1) :
            rtime = 10
            break
        elif(rtime == 2) :
            rtime =12
            break
        elif(rtime == 3) :
            rtime =14
            break
        elif(rtime == 4) :
            rtime =16
            break
        elif(rtime == 5) :
            rtime =18
            break
        elif(rtime == 6) :
            rtime =20
            break
        else :
            print("잘못입력하셨습니다. 다시 입력해주세요","\n")
            rtime = int(input(""))

    r_sql = "select * from reservation where sname = %s AND rdate = %s AND rtime = %s";
    r_val = (sname, rdate, rtime)
    curs.execute(r_sql, r_val)
    rows = curs.fetchall()

    if (curs.rowcount) :
        print("\n","이미 예약된 시간입니다. 다시 선택해주세요.","\n")
        mem_reservation()

    print("\n", "--------------------")
    print("예약 정보")
    print("스터디룸 : ", sname)
    print("예약날짜 : ", rdate)
    print("예약시간 : ", rtime)
    print("--------------------", "\n")

    while True :
        print("\n", "위의 정보로 예약하시겠습니까?", "\n")
        print("1. 예약   2. 취소","\n")
        r_insert = int(input(""))

        if (r_insert == 1) :
            r_sql = "insert into reservation(mid, sname, rdate, rtime) values(%s, %s, %s, %s)"
            r_val = (mid, sname, rdate, rtime)
            curs.execute(r_sql, r_val)
            conn.commit()

            rnum_sql = "select rnum from reservation where mid = %s and sname = %s and rdate = %s and rtime = %s"
            curs.execute(rnum_sql, r_val)
            rnum = curs.fetchall()

            rc_sql = "insert into r_check(rnum) values(%s)"
            curs.execute(rc_sql, rnum)
            conn.commit()
            
            print("예약이 완료되었습니다. 메인화면으로 돌아갑니다.","\n")
            mem_main()
            
        elif(r_insert == 2) :
            print("예약이 취소되었습니다. 메인화면으로 돌아갑니다.","\n")
            mem_main()

        else :
            print("잘못선택하셨습니다. 다시 선택해주세요")




# 예약 확인 및 취소

def mem_reservation_check() :
    print(mname,"님의 예약 내역입니다.")
    c_sql = "select r.rnum, r.sname, r.rdate, r.rtime, c.cstate from reservation as r join r_check as c where r.rnum = c.rnum and r.mid = %s"
    curs.execute(c_sql, mid)
    rows = curs.fetchall()

    print()
    print("-----------------------------------","\n")

    if(not curs.rowcount) :
        print("예약내역이 없습니다.")
    else :
        for row in rows :
            print("예약번호".ljust(5), "스터디룸".ljust(5), "예약날짜".ljust(10), "예약시간".ljust(10), "예약상태".ljust(10))
            print("--------------------------------------------------------")
            print(row[0],"        ", row[1].ljust(10), row[2].ljust(15), row[3],":00 시".ljust(12), row[4], sep="")
    print()
    

    while True :
        rc_sel = int(input("1. 돌아가기   2. 예약취소하기"))
        
        if (rc_sel == 1) :
            mem_main()
        elif(rc_sel == 2) :
            cancel_num = input("취소할 예약의 예약번호를 입력해주세요.")
            cancel_csql = "delete from r_check where rnum = %s"
            cancel_rsql = "delete from reservation where rnum = %s"

            curs.execute(cancel_csql, cancel_num)
            conn.commit()
            
            curs.execute(cancel_rsql, cancel_num)
            conn.commit()
            print()
            print("예약이 취소되었습니다.")
            print()
            mem_reservation_check()
        else :
            print()
            print("잘못선택하셨습니다. 다시 선택해주세요")
            print()



# 비밀번호 변경

def mem_update_pw() :
    print()

    while True :
        upw = input("변경할 비밀번호를 입력하세요 : ")
        upw_check = input("비밀번호를 한번 더 입력하세요 : ")

        if (upw != upw_check) :
            print("비밀번호가 일치하지 않습니다. 다시 입력해주세요","\n")
        else :
            break
    upw_sql = "update member set mpw = %s where mid = %s"
    upw_val = (upw, mid)
    curs.execute(upw_sql, upw_val)
    conn.commit()

    print()
    print("비밀번호가 변경되었습니다. 다시 로그인해주세요.")
    print()
    logout()


        
# 회원탈퇴

def mem_delete() :
    print()
    print("예약 내역이 모두 삭제됩니다. 정말로 탈퇴하시겠습니까?")
    del_sel = int(input("1. 예    2. 아니오"))

    while True :
        if (del_sel == 1) :
            del_csql = "delete from r_check where rnum = (select rnum from reservation where mid = %s)"
            curs.execute(del_csql, mid)
            conn.commit()
            
            del_rsql = "delete from reservation where mid = %s"
            curs.execute(del_rsql, mid)
            conn.commit()
            
            del_msql = "delete from member where mid = %s"
            curs.execute(del_msql, mid)
            conn.commit()

            print("탈퇴가 완료되었습니다")
            logout()
            
        elif (del_sel == 2) :
            print("취소되었습니다.")
            mem_main()
            
        else :
            print("잘못선택하셨습니다. 다시 선택해주세요")



# 관리자 메인

def admin_main() :
    print()
    print("|-----------스터디룸 예약하기-----------|")
    print("|                                       |")
    print("    ", mid,"(", mname, ")님으로 로그인중입니다.")
    print("|                                       |")
    print("|      1. 예약관리   2. 회원목록        |")
    print("|                                       |")
    print("|              3. 로그아웃              |")
    print("|                                       |")
    print("|_______________________________________|")
    admin_sel = int(input())
    
    if(admin_sel == 1) :
        admin_reservation()

    elif(admin_sel == 2) :
        admin_memlist()

    elif(admin_sel == 3) :
        logout()

    else:
        print("잘못선택하셨습니다. 다시 선택해주세요.","\n")
        admin_main()



def admin_reservation() :
    
    while True :
        print()
        admin_rsql = "select distinct r.rnum, m.mname, r.sname, s.scapacity, r.rdate, r.rtime, c.cstate from reservation as r, member as m, studyroom as s, r_check as c join member, studyroom, r_check where r.mid = m.mid and r.rnum = c.rnum and r.sname = s.sname"
        curs.execute(admin_rsql)
        rows = curs.fetchall()
        
        print("예약번호", "회원이름", "스터디룸", "수용인원", "예약날짜", "예약시간", "예약상태")
        print("--------------------------------")
        for row in rows :
            print(row[0], row[1], row[2], row[3], row[4], row[5], row[6])

        admin_r_sel = int(input("1. 돌아가기   2. 예약상태 변경"))
        
        if (admin_r_sel == 1) :
            admin_main()
            
        elif(admin_r_sel == 2) :
            up_rnum = input("예약상태를 변경할 예약의 예약번호를 입력해주세요.")
            up_state = input("예약상태를 입력해주세요")
            up_rsql = "update r_check set cstate = %s where rnum = %s"
            up_rval = (up_state, up_rnum)
            curs.execute(up_rsql, up_rval)
            conn.commit()

            print()
            print("예약상태가 업데이트되었습니다.")
            print()
            admin_reservation()            
        else :
            print()
            print("잘못선택하셨습니다. 다시 선택해주세요")
            print()
    admin_reservation()

    

def admin_memlist() :
    print()
    print("회원 목록")
    mem_sql = "select * from member"
    curs.execute(mem_sql)
    rows = curs.fetchall()

    print()
    print("-----------------------------------","\n")

    if(not curs.rowcount) :
        print("등록된 회원이 없습니다.")
    else :
        print()
        print("회원 ID", "회원이름", "전화번호")
        print("--------------------------------")
        for row in rows :
            print(row[0], row[1], row[2], row[3])

    print("\n","메인화면으로 돌아갑니다.")
    admin_main()
    


    
# 공통

def logout() :
    mname = ""
    mid = ""
    mpw = ""
    print()
    print("로그아웃 되었습니다.")

    index()
    
index()






