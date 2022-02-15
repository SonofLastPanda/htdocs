import snowflake.connector

# Gets the version
ctx = snowflake.connector.connect(
    user='BATGIRL',
    password='Ims*1234',
    account='se02466.europe-west4.gcp'
    )
cs = ctx.cursor()
try:
    cs.execute("SELECT current_version()")
    one_row = cs.fetchone()
    print(one_row[0])
finally:
    cs.close()
ctx.close()