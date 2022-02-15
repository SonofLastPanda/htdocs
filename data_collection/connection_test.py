import snowflake.connector

# Gets the version
ctx = snowflake.connector.connect(
    user='BATGIRL',
    password='Ims*1234',
    account='se02466.europe-west4.gcp'
    )
cs = ctx.cursor()
try:
    cs.execute("USE BATGIRL_PROJECT")
    cs.execute("SELECT * From USERS;")
    one_row = cs.fetchall()
    print(one_row)
finally:
    cs.close()
ctx.close()
