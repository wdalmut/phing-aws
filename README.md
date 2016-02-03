# Corley Phing AWS Tasks

A group of task in order to integrate Phing with AWS.

## ElasticBeanstalk

Deploy your bundle in AWS ElasticBeanstalk

```xml
<project>
    <taskdef name="beanstalk" classname="Corley\Phing\BeanstalkTask" />
    <target name="deploy" depends="upload">
        <echo msg="Deploy application '${APP_NAME}' on ElasticBeanstalk using name '${BUNDLE_NAME}'" />
        <beanstalk
            key="${amazon.key}"
            secret="${amazon.secret}"
            region="${amazon.region}"
            application="${APP_NAME}"
            version="${BUNDLE_NAME}"
            bucket="${amazon.bucket}"
            object="${BUNDLE_NAME_ZIP}"
            />
    </target>
</project>
```

## CodeDeploy

Deploy your bundle in AWS CodeDeploy

```xml
<project>
    <taskdef name="codedeploy" classname="Corley\Phing\CodeDeployTask" />
    <target name="deploy" depends="upload">
        <echo msg="Deploy application '${APP_NAME}' with CodeDeploy using name '${BUNDLE_NAME}'" />
        <codedeploy
            key="${amazon.key}"
            secret="${amazon.secret}"
            region="${amazon.region}"
            application="${APP_NAME}"
            version="${BUNDLE_NAME}"
            bucket="${amazon.bucket}"
            object="${BUNDLE_NAME_ZIP}"
            />
    </target>
</project>
```

## Upload on S3

```xml
<project>
    <taskdef name="s3" classname="Corley\Phing\S3PutTask" />
    <target name="upload" description="Deploy production bundle to S3" depends="bundle">
        <echo msg="Upload '${BUNDLE_NAME_ZIP}' on S3 buckey: '${amazon.bucket}' using key: '${amazon.key}'" />
        <s3
            key="${amazon.key}"
            secret="${amazon.secret}"
            bucket="${amazon.bucket}"
            source="${BUNDLE_NAME_ZIP}"
            object="${BUNDLE_NAME_ZIP}" />
    </target>
</project>
```

