# Author:Leon
from __future__ import print_function
import requests
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
import time
import re

pattern = re.compile(r'http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\(\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+')
chrome_opt = Options()
chrome_opt.binary_location = '/usr/bin/google-chrome-stable'
chrome_opt.add_argument('--headless')
chrome_opt.add_argument('--disable-gpu')
chrome_opt.add_argument('--window-size=1366,768')
chrome_opt.add_argument("--no-sandbox")

# Modification
url = "http://web1/dmfKUQsqRY2C3Ph857x54hSduc6j3ARBesTb_bot.php"
report_url = "http://web1/dmfKUQsqRY2C3Ph857x54hSduc6j3ARBesTb_report.php"
cookie1 = {'name': 'token', 'value': 'dmfKUQsqRY2C3Ph857x54hSduc6j3ARBesTb'}
with open("/var/xssbot/xssbot.log", "w+") as f:
    while 1:
        try:
            req = requests.get(url)
            turl = req.text.split("\n")[0].strip()
            if (not turl):
                time.sleep(20)
                continue
            browser = webdriver.Chrome(
                executable_path='/var/xssbot/chromedriver', chrome_options=chrome_opt)
            f.write("REQUEST: " + turl + "\n")
            browser.get(turl)
            f.write('OK: %s\n' % browser.current_url)
            f.flush()
        except Exception as e:
            f.write('ERROR: %s\n' % e)
            f.flush()
            time.sleep(20)
            continue
        finally:
            try:
                if (turl):
                    requests.post(report_url, data={"url": turl})
                    turl = None
                if (browser):
                    time.sleep(2)
                    browser.quit()
                    browser = None
            except Exception:
                pass
