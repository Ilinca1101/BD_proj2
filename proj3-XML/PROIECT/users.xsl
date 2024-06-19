<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:svg="http://www.w3.org/2000/svg">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
        <head>
            <title>User List</title>
            <link rel="stylesheet" href="assets/css/main.css" />
        </head>
        <body>
            <h2>User List</h2>
            <ul>
                <xsl:for-each select="users/user">
                    <li>
                        <a href="user_profile.php?id={id}">
                            <xsl:value-of select="nume"/>
                        </a>
                        <p>Email: <xsl:value-of select="email"/></p>
                        <p>Formula:</p>
                        <xsl:copy-of select="math:math"/>
                        <p>SVG Image:</p>
                        <xsl:copy-of select="svg:svg"/>
                    </li>
                </xsl:for-each>
            </ul>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
