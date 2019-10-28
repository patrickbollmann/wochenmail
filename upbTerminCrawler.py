import requests
from datetime import datetime
import pymysql

def getloc(l):
    x = requests.get(l)
    x.headers['content-type']
    y =x.text
    a = y.split("<div class=\"event-date\">")
    return (a[1].split("| ")[2].split("</div>")[0].strip())





conn = pymysql.connect(host="db.danielki.de",user="user",
                                        passwd="pass,
                                        db="wochenmail",
										use_unicode=True,
										charset="utf8")
cur = conn.cursor()

r = requests.get('https://upb.de/veranstaltungen')
r.headers['content-type']
content =r.text
event = content.split("<!-- THIS SECTION IS A SINGLE EVENT -->")
event.pop(0)
for e in event:
    try:
        w = e.split("<div class=\"date\">")
        x = w[1].split(", ")
        d = x[1].split("| ")
        date = d[0].strip()
        t = d[1].split("</div>")
        time = t[0].split(" ")[0].strip()
        l = e.split("<a href=\"")
        li = l[1].split("/\">")
        link = li[0].strip()
        ti = li[1].split("</a>")
        title = ti[0].strip()
        te = e.split("<span><p>")
        teaser = te[1].split("</p></span>")[0]
        location = getloc(link)

        time = datetime.strptime(time,"%H.%M").strftime("%H:%M")
        date = datetime.strptime(date,"%d.%m.%Y").strftime("%Y-%m-%d")
        row=[date, time, title, teaser, link, location, "27"]
        try:
            cur.execute("INSERT INTO `event` (`date`, `time`, `name`, `description`, `link`, `location`, `person_id`) VALUES ("+",".join(list(map(lambda x:"\""+x+"\"",row)))+ ");")
            conn.commit()
            print("Termin: "+title+" Eingetragen")
        except pymysql.IntegrityError as e:
            print(e)
    except(IndexError):
        pass